<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChambreController extends AbstractController
{
    #[Route('/chambre', name: 'app_chambre')]
    public function chambre(Request $Request): Response
    {
        return $this->render('chambre/index.html.twig', [
            'controller_name' => 'ChambreController',
        ]);
    }
}
