<?php

namespace App\Form;

use App\Entity\Poids;
use App\Entity\Taille;
use App\Entity\Annonces;
use App\Entity\Categorie;
use App\Entity\ModeTransport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AnnoncesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('expediteur', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'email',

            ])
            ->add('destinataire', TextType::class)
            ->add('adresse', TextType::class)
            ->add('codePostal', TextType::class)
            ->add('ville', TextType::class)
            ->add('description', TextType::class)
            ->add('date_livraison', DateTimeType::class)
            ->add('heure_livraison', DateTimeType::class)
            ->add(
                'distance',
                ChoiceType::class,
                [
                    'choices' => [
                        '0 - 5' => '0 - 5',
                        '5 - 10' => '5 - 10',
                        '10 - 15' => '10 - 15',
                        '15 - 25' => '15 -25'
                    ]
                ]
            )
            ->add('remuneration_livreur', TextType::class)
            ->add('commentaire', TextType::class)
            ->add('status', TextType::class)
            ->add('poids', EntityType::class, [
                'class' => Poids::class,
                'choice_label' => 'decription'
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'titre',
            ])
            ->add('taille', EntityType::class, [
                'class' => Taille::class,
                'choice_label' => 'titre',
            ])
            ->add('mode_transport', EntityType::class, [
                'class' => ModeTransport::class,
                'choice_label' => [
                    'Voiture' => 'Voiture',
                    'Scooter' => 'Scooter',
                    'Velo' => 'Vélo',
                    'autre' => 'autre'
                ],
                'multiple' => 'true'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
