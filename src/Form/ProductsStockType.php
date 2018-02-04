<?php

namespace App\Form;

use App\Entity\ProductsStock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsStockType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("colorValue", TextType::class,
                [
                    "label" =>  "Couleur"
                ]
            )
            ->add("sizeValue", TextType::class,
                [
                    "label" =>  "Taille"
                ]
            )
            ->add("stockValue", IntegerType::class,
                [
                    "label" =>  "Quantité"
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ["data_class"     =>  ProductsStock::class]
        );
    }
}
