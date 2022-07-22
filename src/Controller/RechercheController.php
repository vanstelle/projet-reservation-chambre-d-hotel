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

    /**
     * @Route("/show/{id}", name="app_chambre_show")
     */
    public function show($id, SessionInterface $session, ChambreRepository $repo, Request $request) 
    {   
        $chambre = $repo->find($id);
                
        return $this->render('recherche/show.html.twig', [
            'chambre' => $chambre,
            'dateDebut' =>  $session->get("dateDebut"),
            'dateFin' =>  $session->get("dateFin")
        ]);
    }
}
