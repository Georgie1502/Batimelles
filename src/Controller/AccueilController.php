<?php

namespace App\Controller;

use App\Form\ArtisaneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Repository\ArtisaneRepository;
use App\Entity\Artisane;


class AccueilController extends AbstractController
{
    #[Route('/accueil', name: 'app_accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

    // #[Route("/", name: "accueil")]

    // public function accueil()
    // {
    //     return $this->render('accueil/accueil.html.twig');
    // }



    //Afficher les artisanes
    #[Route("/trouver", name: "accueil_afficher")]

    public function afficher()
    {
        return $this->render('accueil/afficher.html.twig');
    }

    





}