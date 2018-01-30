<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewUserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("user_email", RepeatedType::class,
                [
                    "type"              =>  EmailType::class,
                    'invalid_message' => 'Les emails saisis ne correspondent pas.',
                    "first_options"     =>  ["label"    =>  "Email"],
                    "second_options"    =>  ["label"    =>  "Confirmez votre Email"],
                ]
            )
            ->add("username", TextType::class, 
                [   "label" => "Pseudonyme" ]
            )
            ->add("password", RepeatedType::class,
                [
                    "type"              =>  PasswordType::class,
                    'invalid_message' => 'Les mots de passe saisis ne correspondent pas.',
                    "first_options"     =>  ["label"    =>  "Mot de passe"],
                    "second_options"    =>  ["label"    =>  "Confirmez votre mot de passe"],
                ]
            )
            ->add("user_gender", ChoiceType::class,
                [
                    "label" => "Genre",
                    "choices"   =>  [
                        "Homme" =>  "homme",
                        "Femme" =>  "femme",
                        "Autre" =>  "autre"
                    ],
                    "expanded"  =>  true
                ]
            )
            ->add("user_first_name", TextType::class, 
                [   "label" => "Votre nom" ]
            )
            ->add("user_last_name", TextType::class, 
                [   "label" => "Votre prénom" ]
            )
            // ->add("roles", ChoiceType::class, 
            //     [   "label" => "Rôle",
            //         "choices"   => [
            //             "Editeur" => 'ROLE_ADMIN',
            //             "Administrateur" => 'ROLE_SUPER_ADMIN',
            //         ]
            //      ]
            // )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => User::class]
        );
    }
}