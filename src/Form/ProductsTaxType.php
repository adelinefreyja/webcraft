<?php

namespace App\Form;

use App\Entity\ProductsTax;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsTaxType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("tax_name", TextType::class,
                [ "label"   =>  "Nom de la taxe" ]
        )
            ->add("tax_value", TextType::class,
                [   "label" =>  "Taux de taxe" ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ["data_class"     =>  ProductsTax::class]
        );
    }
}
