<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/album/{id}/edit', name: 'album_edit', requirements: ['id' => '\d+'])]
    public function edit(Request $request, Album $album, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('album', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('album/edit.html.twig', [
            'album' => $album,
            'form' => $form,
        ]);
    }

    #[Route('/album/{id}/delete', name: 'album_delete', requirements: ['id' => '\d+'])]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $entity_manager = $doctrine->getManager();
        $album = $entity_manager->getRepository(Album::class)->find($id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$id
            );
        }

        $entity_manager->remove($album);
        $entity_manager->flush();

        return $this->redirectToRoute('album');
    }
}
