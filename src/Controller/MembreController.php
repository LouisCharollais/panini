<?php

namespace App\Controller;

use App\Entity\Membre;
use App\Form\MembreType;
use App\Repository\MembreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/membre')]
class MembreController extends AbstractController
{
    #[Route('/', name: 'membre_index', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(MembreRepository $membreRepository): Response
    {
        return $this->render('membre/index.html.twig', [
            'membres' => $membreRepository->findAll(),
        ]);
    }

    #[Route('/{membre_id}', name: 'membre_show', requirements: ['membre_id' => '\d+'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function show(ManagerRegistry $doctrine, $membre_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);
        return $this->render('membre/show.html.twig', [
            'membre' => $membre,
        ]);
    }

    #[Route('/{id}/edit', name: 'membre_edit', methods: ['GET', 'POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function edit(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('membre_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('membre/edit.html.twig', [
            'membre' => $membre,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'membre_delete', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function delete(Request $request, Membre $membre, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$membre->getId(), $request->request->get('_token'))) {
            $entityManager->remove($membre);
            $entityManager->flush();
        }

        return $this->redirectToRoute('membre_index', [], Response::HTTP_SEE_OTHER);
    }
}
