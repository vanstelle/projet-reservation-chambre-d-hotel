<?php

namespace App\Controller;

use App\Repository\ChambreRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RechercheController extends AbstractController
{

    /**
     * @Route("/recherche/{destination}/{dateDebut}/{dateFin}", name="app_recherche")
     */
    public function rechercher(string $destination, string $dateDebut, string $dateFin,  SessionInterface $session, ChambreRepository $repo, Request $request) 
    {   
        $chambres = $repo->findAll();
        $session->set("destination", $destination);
        $session->set("dateDebut", $dateDebut);
        $session->set("dateFin", $dateFin);
        
        return $this->render('recherche/recherche.html.twig', [
            'chambres' => $chambres,
        ]);
    }
}
