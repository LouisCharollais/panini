<?php

namespace App\Controller;

use App\Entity\Panini;
use App\Form\PaniniType;
use App\Entity\Album;
use App\Entity\Membre;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/membre/{membre_id}/album/{album_id}/add_panini', name: 'panini_add', methods: ['GET', 'POST'])]
    public function addPanini(ManagerRegistry $doctrine, $membre_id, $album_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $album = $entity_manager->getRepository(Album::class)->find($album_id);
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);
        $paninis = $album->getPaninis();

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$album_id
            );
        }

        return $this->render('panini/add.html.twig', [
            'paninis' => $paninis,
            'album' => $album,
            'membre' => $membre,
        ]);
    }

    #[Route('/membre/{membre_id}/album/{album_id}/new_panini', 'new_panini', methods: ['GET', 'POST'])]
public function newPanini(Request $request, ManagerRegistry $doctrine, $membre_id, $album_id)
    {
        $entity_manager = $doctrine->getManager();
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);
        $albums = $membre->getAlbums();

        if (!$albums) {
            throw $this->createNotFoundException(
                'No album found for id ' . $album_id
            );
        }

        $panini = new Panini();
        $form = $this->createForm(PaniniType::class, $panini);
        $form->handleRequest($request);
        return $this->render('panini/_form.html.twig', [
            'panini' => $panini,
            'form' => $form->createView(),
            'albums' => $albums,
            'membre' => $membre
        ]);
    }
}
