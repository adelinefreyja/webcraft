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

class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("user_email", RepeatedType::class,
                [
                    "type"              =>  EmailType::class,
                    "first_options"     =>  ["label"    =>  "Email"],
                    "second_options"    =>  ["label"    =>  "Repeat Email"],
                ]
            )
            ->add("username", TextType::class)
            ->add("password", RepeatedType::class,
                [
                    "type"              =>  PasswordType::class,
                    "first_options"     =>  ["label"    =>  "Password"],
                    "second_options"    =>  ["label"    =>  "Repeat Password"],
                ]
            )
            ->add("user_gender", ChoiceType::class,
                [
                    "choices"   =>  [
                        "Homme" =>  true,
                        "Femme" =>  true,
                        "Autre" =>  true
                    ],
                    "expanded"  =>  true
                ]
            )
            ->add("user_first_name", TextType::class)
            ->add("user_last_name", TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => User::class]
        );
    }
}