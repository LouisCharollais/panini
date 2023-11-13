<?php

namespace App\Controller;

use App\Entity\Equipe;
use App\Entity\Panini;
use App\Entity\Membre;
use App\Form\EquipeType;
use App\Repository\EquipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

#[Route('/equipe')]
class EquipeController extends AbstractController
{
    #[Route('/', name: 'equipe_index', methods: ['GET'])]
    public function index(EquipeRepository $equipeRepository): Response
    {
        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipeRepository->findAll(),
        ]);
    }

    #[Route('/membre/{membre_id}/equipe/new', name: 'equipe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $membre_id): Response
    {
        $equipe = new Equipe();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity_manager = $entityManager->getRepository(Membre::class)->find($membre_id);
            $equipe->setCreateur($entity_manager);
            $entityManager->persist($equipe);
            $entityManager->flush();
            $equipe_id = $equipe->getId();

            return $this->redirectToRoute('equipe_show', ['membre_id' => $membre_id, 'equipe_id' => $equipe_id]);
        }

        return $this->render('equipe/new.html.twig', [
            'equipe' => $equipe,
            'membre_id' => $membre_id,
            'form' => $form,
        ]);
    }

    #[Route('/membre/{membre_id}/equipe/{equipe_id}', name: 'equipe_show', methods: ['GET'])]
    public function show($equipe_id, $membre_id, ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $membre = $entityManager->getRepository(Membre::class)->find($membre_id);
        $equipe = $entityManager->getRepository(Equipe::class)->find($equipe_id);

        if (!$equipe) {
            throw $this->createNotFoundException(
                'No equipe found for id '.$equipe_id
            );
        }

        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
            'membre' => $membre,
        ]);
    }

    #[Route('/{id}/edit', name: 'equipe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Equipe $equipe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('equipe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('equipe/edit.html.twig', [
            'equipe' => $equipe,
            'form' => $form,
        ]);
    }

    #[Route('/membre/{membre_id}/equipe/{equipe_id}/delete', name: 'equipe_delete', requirements: ['equipe_id' => '\d+'])]
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

    #[Route('/{equipe_id}/panini/{panini_id}', name: 'equipe_panini_show', methods: ['GET'])]
    public function paniniShow(
       #[MapEntity(id: 'equipe_id')]
       Equipe $equipe,
       #[MapEntity(id: 'panini_id')]
       Panini $panini
   ): Response
   {
       if(! $equipe->getPaninis()->contains($panini)) {
           throw $this->createNotFoundException("Ce panini n'a pas été trouvé dans cette équipe");
       }

       if(! $equipe->isPublished()) {
           throw $this->createAccessDeniedException("Vous n'avez pas l'accès à cette ressource");
       }
       return $this->render('equipe/panini_show.html.twig', [
           'panini' => $panini,
           'equipe' => $equipe
       ]);
   }
}
