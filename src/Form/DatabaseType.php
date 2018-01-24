<?php

namespace App\Form;

use App\Entity\Database;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DatabaseType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("db_host", TextType::class)
            ->add("db_username", TextType::class)
            ->add("db_password", TextType::class,
                ["required" =>  false]
            )
            ->add("db_name", TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => Database::class]
        );
    }
}