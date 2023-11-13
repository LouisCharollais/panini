<?php

namespace App\Controller;

use App\Entity\Album;
use App\Form\AlbumType;
use App\Entity\Membre;
use App\Form\MembreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class AlbumController extends AbstractController
{
    #[Route('/membre/{membre_id}/album', name: 'album')]
    public function index(ManagerRegistry $doctrine, $membre_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);

        if (!$membre) {
            throw $this->createNotFoundException(
                'No membre found for id '.$membre_id
            );
        }
        $albums = $membre->getAlbums();

        return $this->render('album/index.html.twig', [
            'albums' => $albums,
        ]);
    }

    #[Route('membre/{membre_id}/album/{album_id}', name: 'album_show', requirements: ['album_id' => '\d+', 'membre_id' => '\d+'])]
    public function show(ManagerRegistry $doctrine, $album_id, $membre_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $album = $entity_manager->getRepository(Album::class)->find($album_id);
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$album_id
            );
        }

        return $this->render('album/show.html.twig', [
            'album' => $album,
            'membre' => $membre,
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

    #[Route('/membre/{membre_id}/album/{album_id}/delete', name: 'album_delete', requirements: ['album_id' => '\d+'])]
    public function delete(ManagerRegistry $doctrine, $membre_id, $album_id): Response
    {
        $entity_manager = $doctrine->getManager();
        $album = $entity_manager->getRepository(Album::class)->find($album_id);
        $membre = $entity_manager->getRepository(Membre::class)->find($membre_id);

        if (!$album) {
            throw $this->createNotFoundException(
                'No album found for id '.$album_id
            );
        }

        $entity_manager->remove($album);
        $entity_manager->flush();

        return $this->redirectToRoute('membre_show', ['membre_id' => $membre_id], Response::HTTP_SEE_OTHER);
    }

    #[Route('/membre/{membre_id}/album/new', name: 'album_new', requirements: ['membre_id' => '\d+'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $membre_id): Response
    {
        $album = new Album();
        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity_manager = $entityManager->getRepository(Membre::class)->find($membre_id);
            $album->setMembre($entity_manager);
            $entityManager->persist($album);
            $entityManager->flush();
            $album_id = $album->getId();

            return $this->redirectToRoute('album_show', ['membre_id' => $membre_id, 'album_id' => $album_id]);
        }

        return $this->render('album/new.html.twig', [
            'album' => $album,
            'membre_id' => $membre_id,
            'form' => $form,
        ]);
    }
}
