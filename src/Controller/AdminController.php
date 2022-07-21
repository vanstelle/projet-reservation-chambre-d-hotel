<?php

namespace App\Controller;

use App\Entity\Chambre;
use App\Form\ChambreFormType;
use App\Repository\ChambreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/ajout-chambre", name="ajout_chambre")
     */
    public function ajout(Request $request, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $chambre = new Chambre();

        $form = $this->createForm(ChambreFormType::class, $chambre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file1 = $form->get('photoForm1')->getData();
            $file2 = $form->get('photoForm2')->getData();
            $file3 = $form->get('photoForm3')->getData();
            $file4 = $form->get('photoForm4')->getData();
            $file5 = $form->get('photoForm5')->getData();

            $fileName1 = uniqid() . '.' . $file1->guessExtension();
            $fileName2 = uniqid() . '.' . $file2->guessExtension();
            $fileName3 = uniqid() . '.' . $file3->guessExtension();

            $fileName4 = null;
            if ($file4 != null) {
               $fileName4 = uniqid() . '.' . $file4->guessExtension();
            }

            $fileName5 = null;
            if ($file5 != null) {
               $fileName5 = uniqid() . '.' . $file5->guessExtension();
            }

           
            try {
                $file1->move($this->getParameter('photos_chambres'), $fileName1);
                $file2->move($this->getParameter('photos_chambres'), $fileName2);
                $file3->move($this->getParameter('photos_chambres'), $fileName3);

                if ($file4 != null) {
                   $file4->move($this->getParameter('photos_chambres'), $fileName4);
                }

                if ($file5 != null) {
                   $file5->move($this->getParameter('photos_chambres'), $fileName5);
                }

            } catch (FileException $e) {
                // gerer les exeption d'upload image
            }

            $user = $this->getUser();

            $chambre->setPhoto1($fileName1);
            $chambre->setPhoto2($fileName2);
            $chambre->setPhoto3($fileName3);
            $chambre->setPhoto4($fileName4);
            $chambre->setPhoto5($fileName5);
            $chambre->setHotel($user->getId());

            $manager->persist($chambre);
            $manager->flush();

            return $this->redirectToRoute('admin_gestion_chambres');

        }

        return $this->render('admin/chambre/formulaire.html.twig', [
            'formChambre' => $form->createView(),
        ]);
    }

    /**
     * @Route("/modifier-chambre/{id<\d+>}", name="modifier_chambre")
     */
    public function modifier($id, Request $request, ChambreRepository $repo, EntityManagerInterface $manager, SluggerInterface $slugger): Response
    {
        $chambre = $repo->find($id);

        $form = $this->createForm(ChambreFormType::class, $chambre);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file1 = $form->get('photoForm1')->getData();
            $file2 = $form->get('photoForm2')->getData();
            $file3 = $form->get('photoForm3')->getData();
            $file4 = $form->get('photoForm4')->getData();
            $file5 = $form->get('photoForm5')->getData();
           
            try {

                if ($file1 != null) {
                    $fileName1 = uniqid() . '.' . $file1->guessExtension();
                    $file1->move($this->getParameter('photos_chambres'), $fileName1);
                    $chambre->setPhoto1($fileName1);
                }
                
                if ($file2 != null) {
                    $fileName2 = uniqid() . '.' . $file2->guessExtension();
                    $file2->move($this->getParameter('photos_chambres'), $fileName2);
                    $chambre->setPhoto2($fileName2);
                }

                if ($file3 != null) {
                    $fileName3 = uniqid() . '.' . $file3->guessExtension();
                    $file3->move($this->getParameter('photos_chambres'), $fileName3);
                    $chambre->setPhoto3($fileName3);
                }
                
                if ($file4 != null) {
                    $fileName4 = uniqid() . '.' . $file4->guessExtension();
                    $file4->move($this->getParameter('photos_chambres'), $fileName4);
                    $chambre->setPhoto4($fileName4);
                }

                if ($file5 != null) {
                    $fileName5 = uniqid() . '.' . $file5->guessExtension();
                    $file5->move($this->getParameter('photos_chambres'), $fileName5);
                    $chambre->setPhoto5($fileName5);
                }

            } catch (FileException $e) {
                // gerer les exeption d'upload image
            }

            $repo->add($chambre, 1);

            return $this->redirectToRoute('admin_gestion_chambres');

        }

        return $this->render('admin/chambre/formulaire.html.twig', [
            'formChambre' => $form->createView(),
        ]);
    }

    /**
     * @Route("/gestion-chambres", name="gestion_chambres")
     */
    public function gestionChambres(ChambreRepository $repo)
    {
        $user = $this->getUser();

        $chambres = $repo->findByHotel($user->getId());

        return $this->render("admin/chambre/gestion-chambres.html.twig", [
            'chambres' => $chambres,
        ]);

    }

    /**
     * @Route("/delete-chambre-{id<\d+>}", name="delete_chambre")
     */
    public function delete($id, ChambreRepository $repo)
    {
        $chambre = $repo->find($id);

        $repo->remove($chambre, 1);

        return $this->redirectToRoute("admin_gestion_chambres");
    }

}
