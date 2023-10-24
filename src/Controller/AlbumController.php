<?php

namespace App\Controller;

use App\Entity\Album;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AlbumController extends AbstractController
{
    #[Route('/album', name: 'album')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entity_manager = $doctrine->getManager();
        $albums = $entity_manager->getRepository(Album::class)->findAll();

        return $this->render('album/index.html.twig', [
            'albums' => $albums,
        ]);
    }

    #[Route('/album/{id}', name: 'album_show', requirements: ['id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, $id): Response
    {
        $entity_manager = $doctrine->getManager();
        $album = $entity_manager->getRepository(Album::class)->find($id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$id
            );
        }

        return $this->render('album/show.html.twig', [
            'album' => $album,
        ]);
    }
}
