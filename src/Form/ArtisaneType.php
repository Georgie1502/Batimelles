<?php

namespace App\Form;

use App\Entity\Artisane;
use App\Entity\Metier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\WeekType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; 
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



class ArtisaneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nom', TextType::class,[
            'label'=> 'Nom',
            'required' => true,
            ]) 
           
            ->add('prenom', TextType::class,[
                'label'=> 'Prénom',
                'required' => true,
                ]) 
            ->add('telephone', TelType::class,[
                'label'=> 'Telephone',
                'required' => true,
                ]) 
            ->add('mail', EmailType::class,[
                'label'=> 'Mail',
                'required' => true,
                ]) 
            ->add('password', PasswordType::class,[
                'label'=> 'Mot de passe',
                'required' => true,
                ]) 
            ->add('adresse', TextType::class,[
                'label'=> 'Adresse',
                'required' => true,
                ]) 
            ->add('nomEntreprise', TextType::class,[
                'label'=> 'Nombre de l\'entreprise',
                'required' => true,
                ])
            ->add('aneesExperience', DateType::class,[
                'label'=> 'Date de creation de l\'entreprise',
                'required' => true,
                ])
            ->add('activation')
            ->add('horaires', WeekType::class,[
                'label'=> 'Horaires',
                'required' => true,
                ])
           // ->add('prestations', ChoiceType::class)
            ->add('metier', EntityType::class, [
                'class'=> Metier::class,
                'label'=>'Choisir le métier',
                'multiple'=> true,
                'expanded'=> false,
              ])
            ->add('Ajouter', SubmitType::class) ; 
            
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Artisane::class,
        ]);
    }
}
