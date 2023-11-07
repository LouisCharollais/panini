<?php

namespace App\Controller;

use App\Entity\Panini;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class PaniniController extends AbstractController
{
    #[Route('/panini/{id}', name: 'panini_show', requirements: ['id' => '\d+'])]
    public function index(ManagerRegistry $doctrine, $id): Response
    {
        $entity_manager = $doctrine->getManager();
        $panini = $entity_manager->getRepository(Panini::class)->find($id);

        if (!$panini) {
            throw $this->createNotFoundException(
                'No panini found for id '.$id
            );
        }

        return $this->render('panini/show.html.twig', [
            'panini' => $panini,
            'controller_name' => 'PaniniController'
        ]);
    }

    #[Route('/panini', name: 'panini_all')]
    public function index_bis(ManagerRegistry $doctrine): Response
    {
        $entity_manager = $doctrine->getManager();
        $paninis = $entity_manager->getRepository(Panini::class)->findAll();

        return $this->render('panini/index.html.twig', [
            'paninis' => $paninis,
        ]);
    }
}
