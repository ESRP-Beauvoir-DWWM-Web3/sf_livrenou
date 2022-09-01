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

class Annonces1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('destinataire', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez le nom de destinataire'
                ],
            ])
            ->add('adresse', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer l\'adresse de destinataire'

                ],
            ])
            ->add('codePostal', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Votre code postal'

                ],
            ])
            ->add('ville', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Quelle ville?'

                ],
            ])
            ->add('description', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Veuillez décrire votre aanonce'

                ],
            ])
            ->add('date_livraison', DateTimeType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            /*->add('heure_livraison', DateTimeType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            */
            ->add(
                'distance',
                ChoiceType::class,
                [
                    'choices' => [
                        '0 - 5' => '0 - 5',
                        '5 - 10' => '5 - 10',
                        '10 - 15' => '10 - 15',
                        '15 - 25' => '15 -25',
                        'placeholder' => 'Kilometre (km)'

                    ],
                ]
            )
            ->add('remuneration_livreur', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entre la somme en €'

                ],
            ])
            ->add('commentaire', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Si vous avez de commentaire'

                ],
            ])
            ->add('status', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
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
                'choice_label' => 'titre',
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
