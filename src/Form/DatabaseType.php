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
            ->add("db_host", TextType::class, 
                [   "label" => "Hôte" ]
            )
            ->add("db_username", TextType::class, 
                [   "label" => "Username" ]
            )
            ->add("db_password", TextType::class,
                [
                    "label" => "Mot de passe de la Base de Données",
                    "required" =>  false
                ]
            )
            ->add("db_name", TextType::class, 
                [   "label" => "Nom de la base de données" ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => Database::class]
        );
    }
}