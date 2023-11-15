<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Membre;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/equipe')]
class EquipeController extends AbstractController
{
    #[Route('/', name: 'equipe_index', methods: ['GET'])]
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipeRepository->findBy(['published'=>true]),
        ]);
    }

    #[Route('membre/{membre_id}/equipe/{equipe_id}', name: 'equipe_show', requirements: ['equipe_id' => '\d+', 'membre_id' => '\d+'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function show(ManagerRegistry $doctrine, $equipe_id, $membre_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);
        $equipe = $entity_manager->getRepository(Equipe::class)->find($equipe_id);

        if (!$equipe) {
            throw $this->createNotFoundException(
                'No equipe found for id '.$equipe
            );
        }

        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
            'membre' => $membre,
        ]);
    }

    #[Route('/membre/{membre_id}/equipe/new', name: 'equipe_new', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function new(Request $request, EntityManagerInterface $entityManager, $membre_id): Response
    {
        $equipe = new Equipe();
        $membre = $entityManager->getRepository(Membre::class)->find($membre_id);
        $equipe -> setCreateur($membre);
        $equipe -> setNom('Nouvelle équipe');
        $entityManager->persist($equipe);
        $entityManager->flush();

        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            //supprimer l'équipe
            $entityManager->remove($equipe);
            $entityManager->flush();

            //message d'erreur
            $this->addFlash('error', 'Une erreur est survenue lors de la création de l\'équipe');
        }else{
            $equipe_id = $equipe->getId();
            $entityManager->flush();

            return $this->redirectToRoute('equipe_show', ['membre_id' => $membre_id, 'equipe_id' => $equipe_id]);
        }

        return $this->render('equipe/new.html.twig', [
            'equipe' => $equipe,
            'membre_id' => $membre_id,
            'form' => $form,
        ]);
    }

    #[Route('/membre/{membre_id}/equipe/{equipe_id}/delete', name: 'equipe_delete', requirements: ['equipe_id' => '\d+'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function delete(ManagerRegistry $doctrine, $membre_id, $equipe_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $album = $entity_manager->getRepository(Equipe::class)->find($equipe_id);
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$equipe_id
            );
        }

        $entity_manager->remove($album);
        $entity_manager->flush();

        return $this->redirectToRoute('membre_show', ['membre_id' => $membre_id], Response::HTTP_SEE_OTHER);
    }

    #[Route('/membre/{membre_id}/equipe/{equipe_id}/edit', name: 'equipe_edit', requirements: ['equipe_id' => '\d+'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function edit(Request $request, $equipe_id, $membre_id, EntityManagerInterface $entityManager): Response
    {
        $equipe = $entityManager->getRepository(Equipe::class)->find($equipe_id);
        $membre = $entityManager->getRepository(Membre::class)->find($membre_id);
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('equipe_show', ['membre_id' => $membre_id, 'equipe_id' => $equipe_id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
            'membre' => $membre,
        ]);
    }
}
