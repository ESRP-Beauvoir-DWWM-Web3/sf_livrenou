<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('mail', EmailType::class, [
            'label' => 'Entrez l\'email :',
            'attr' => [
                'class' => 'form-control'
            ]
        ])
            ->add('roles', ChoiceType::class,[
                'label' => 'Choisissez un ou plusieurs rôles :',
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Expéditeur' => 'ROLE_EXPEDITEUR',
                    'Livreur' => 'ROLE_LIVREUR',
                ],
                'choice_attr' => [
                    'Administrateur' => ['class'=>'me-1'],
                    'Exoéditeur' => ['class'=>'ms-3 me-1'],
                    'Livreur' => ['class'=>'ms-3 me-1'],
                ],
                'multiple' => true,
                'expanded' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])            
            ->add('password', PasswordType::class, [
                'attr' => [
                    'class'=>'form-control'
                ]
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'class'=>'form-control'
                ]
            ])
            ->add('prenom', TextType::class,[
                'attr' => [
                    'class'=>'form-control'
                ]
            ])
            ->add('nomEntreprise', TextType::class,[
                'attr' => [
                    'class'=>'form-control'
                ]
            ])
            ->add('adresse', TextareaType::class, [
                'label'=>'Entrez une adresse :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('codePostal',IntegerType::class, [
                'label'=>'Entrez un code postal :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('ville', TextType::class, [
                'label'=>'Entrez la ville :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])            
            ->add('email', EmailType::class, [
                'label' => 'Entrez l\'email :',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
