<?php

namespace App\Controller;

use App\Form\ArtisaneType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Artisane;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface; 


#[Route('/artisane', name: 'app_artisane')]
class ArtisaneController extends AbstractController
{
    
    //recuperation de toutes les artisanes
    #[Route('artisane/trouver', name: 'artisane_trouver')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Artisane::class);
        $artisanes = $repository->findAll();
        return $this->render('artisane/index.html.twig', [
            'artisanes' => $artisanes,
        ]);
    }
    
    //ajout une artisane en bdd
    #[Route('/rejoindre', name: 'artisane_rejoindre')]

    public function rejoindre(ManagerRegistry $doctrine, EntityManagerInterface $manager,
    UserPasswordHasherInterface $hash, Request $request):Response{
       
        //Instance d'un objet Artisane
        $artisane = new Artisane();

        //Variable qui contient un objet ArtisaneType(Formulaire)
        $form = $this->createForm(ArtisaneType::class, $artisane);

        //Mon formulaire va aller traiter la requete,Stocker le résultat du formulaire (analise)
        $form->handleRequest($request);

        //Verifier si le formulaire a été soumis. Condition validation du formulaire
        if($form->isSubmitted() && $form->isValid()){

            //Récuperation du mot de passe en clair
            $pass=$_POST['artisane']['password'];

            //Hasher le mot de passe
            $hassPassword = $hash->hashPassword($artisane, $pass);

            //Setter les valeurs (mot de passe activation et le role)
            $artisane->setPassword($hassPassword);
            $artisane->setRoles(['ROLE_USER']);
            // $manager = $doctrine->getManager();

            //faire persister les données
            $manager->persist($artisane);
            //ajout en BDD
            $manager->flush();

            //Message de succès
            $this->addFlash('success', (" Merci ".$artisane->getPrenom()." 
            d’avoir soumis votre profil. Notre équipe étudie les informations que tu as fournies.
            Nous reviendrons vers vous dès que possible."));
            return $this->redirectToRoute('artisane_rejoindre');
        } 
    
        return $this->render('artisane/rejoindre.html.twig', [
            'form' => $form->createView()
        ]);
    }
}