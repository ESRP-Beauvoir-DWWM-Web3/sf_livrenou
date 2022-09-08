<?php

namespace App\Form;

use App\Entity\Poids;
use App\Entity\Taille;
use App\Entity\Annonces;
use App\Entity\Categorie;
use App\Entity\Distance;
use App\Entity\ModeTransport;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
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
            ->add('commentaire', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Si vous avez de commentaire'

                ],
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => function(Categorie $categorie){
                    return $categorie->getTitre().' - coef '.$categorie->getCoef();
                },
            ])
            ->add('poids', EntityType::class, [
                'class' => Poids::class,
            'choice_label' => function(Poids $poids){
                return $poids->getTitre().' - coef '.$poids->getCoef();
            }
            ])
            ->add('taille', EntityType::class, [
                'class' => Taille::class,
                'choice_label' => function(Taille $taille){
                    return $taille->getTitre().' - coef '.$taille->getCoef();
                }
                ])
            ->add('distance', EntityType::class, [
                    'class' => Distance::class,
                    'choice_label' => function(Distance $distance){
                        return $distance->getTitre().' - coef '.$distance->getCoef();
                    }
                ]
            )
            ->add('remuneration_livreur', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entre la somme en €'

                ],
            ])
            ->add('mode_transport', EntityType::class, [
                'class' => ModeTransport::class,
                'choice_label' => 'titre',
                'multiple' => 'true'
            ])
            ->add('picture', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize'=>'16384k',
                        'maxSizeMessage'=>'Taille de fichier trop grande',
                        'mimeTypes'=>[
                            'image/jpeg',
                            'image/png',
                            'image/svg',
                        ],
                        'mimeTypesMessage'=>'Extension de fichier invalide',
                    ])
                    ],
                'attr'=>[
                    'class'=>'form-control',
                ],
                'data_class'=>null,
            ]);

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonces::class,
        ]);
    }
}
