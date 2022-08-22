<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('nom', TextType::class)
            ->add('prenom', TextType::class)
            ->add('nomEntreprise', TextType::class)
            ->add('adresse', TextareaType::class)
            ->add('codePostal', IntegerType::class)
            ->add('ville', TextType::class)
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class,[
                'type'=>PasswordType::class,
                'invalid_message'=>'Le mot de passe et la confirmation doivent être identique',
                'label'=>'Votre mot de passse',
                'required'=>true,
                'first_options'=>[
                    'label'=>'Mot de passe',
                    'attr'=>[
                        'placeholder'=>'Veuillez entrez votre mot de passe'
                    ]
                ],
                'second_options'=>[
                    'label'=>'Confirmez votre le mot de passe',
                    'attr'=>[
                        'placeholder'=>'Veuillez confirmez votre le mot de passe'
                    ]
                ]])
            
            ->add('submit', SubmitType::class,[
                'label'=> "S'inscrire"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
