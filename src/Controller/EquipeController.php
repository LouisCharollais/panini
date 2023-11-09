<?php

namespace App\Controller;

use App\Entity\Equipe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class EquipeController extends AbstractController
{
    #[Route('/equipe', name: 'equipe')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entity_manager = $doctrine->getManager();
        $equipes = $entity_manager->getRepository(Equipe::class)->findAll();

        return $this->render('equipe/index.html.twig', [
            'equipes' => $equipes,
        ]);
    }

    #[Route('/equipe/{id}', name: 'equipe_show', requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $entity_manager = $doctrine->getManager();
        $equipe = $entity_manager->getRepository(Equipe::class)->find($id);

        if (!$equipe) {
            throw $this->createNotFoundException(
                'No Gallary found for id' .$id
            );
        }

        return $this->render('equipe/show.html.twig', [
            'equipe' => $equipe,
        ]);
    }
}
