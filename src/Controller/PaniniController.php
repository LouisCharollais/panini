<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaniniController extends AbstractController
{
    #[Route('/panini', name: 'app_panini')]
    public function index(): Response
    {
        return $this->render('panini/index.html.twig', [
            'controller_name' => 'PaniniController',
        ]);
    }
}
