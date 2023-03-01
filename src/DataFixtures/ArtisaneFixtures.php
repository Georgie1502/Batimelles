<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Artisane;
use App\Entity\TypeUtilisateur;
use Faker;
use Faker\Factory;
use App\Entity\Metier;



class ArtisaneFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $artisanes=[];
        $typeUtis=[];
        $metiers=[];

        //boucle pour ajouter types de utilisateur
        for ($i = 0; $i < 3; $i ++ ){
            $typeUti = new TypeUtilisateur();
            $typeUti->setNom($faker->userName(3));
            $typeUtis[] = $typeUti;
            $manager->persist($typeUti);
        }
         //boucle pour ajouter des metiers
        for ($i = 0; $i < 8; $i ++){
            $metier = new Metier();
            $metier->setNom($faker->jobTitle());
            $metiers[]=$metier;
            $manager->persist($metier);

        }
        //boucle pour ajouter artisanes
    
        for ($i=0; $i <10; $i++){
            $artisane = new Artisane();
            $artisane->setNom($faker->lastName());
            $artisane->setPrenom($faker->firstNameFemale());
            $artisane->setTelephone($faker->phoneNumber());
            $artisane->setMail($faker->freeEmail());
            $artisane->setPassword(password_hash($faker->password(), PASSWORD_DEFAULT));
            $artisane->setAdresse($faker->address());
            $artisane->setNomEntreprise($faker->company());
            $artisane->setAneesExperience($faker->dateTime());
            $artisane->setActivation($faker->boolean());
            $artisane->setHoraires("Lundi 09h00 - 18h00
                Mardi 09h00 - 18h00
                Mercredi 09h00 - 18h00
                Jeudi	09h00 - 18h00
                Vendredi	09h00 - 18h00");
            $artisane->setTypeUtilisateur($typeUtis[$faker->numberBetween(0, 2)]);
            $artisane->setMetier($metiers[$faker->numberBetween(0, 3)]);
            $artisanes[]=$artisane;
            $manager->persist($artisane);
                
            }
            

        $manager->flush();
    }
}
