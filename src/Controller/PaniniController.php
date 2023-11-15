<?php

namespace App\Controller;

use App\Entity\Panini;
use App\Form\PaniniType;
use App\Entity\Album;
use App\Entity\Membre;
use Doctrine\ORM\EntityManagerInterface;
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
                'No panini found for id ' . $id
            );
        }

        return $this->render('panini/show.html.twig', [
            'panini' => $panini,
            'controller_name' => 'PaniniController',
            'imageName' => $panini->getImageName()
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

    //new panini
    #[Route('/membre/{membre_id}/album/{album_id}/add_panini/new', name: 'panini_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, $membre_id, $album_id): Response
    {
        $panini = new Panini();
        $membre = $entityManager->getRepository(Membre::class)->find($membre_id);
        $album = $entityManager->getRepository(Album::class)->find($album_id);
        $panini->setMembre($membre);
        $panini->setNom('Nouveau panini');
        $panini->setAlbum($album);
        $entityManager->persist($panini);
        $entityManager->flush();

        $form = $this->createForm(PaniniType::class, $panini);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            //supprimer l'album
            $entityManager->remove($panini);
            $entityManager->flush();
            //message d'erreur
            $this->addFlash('error', 'Erreur lors de la création du panini');
        }else{
            $panini_id = $panini->getId();
            $entityManager->flush();

            return $this->redirectToRoute('panini_show', ['id' => $panini_id]);
        }

        return $this->render('panini/new.html.twig', [
            'panini' => $panini,
            'album' => $album,
            'membre' => $membre,
            'form' => $form,
        ]);
    }
}
