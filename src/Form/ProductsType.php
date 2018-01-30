<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductsType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("productName", TextType::class,
                ["label"    =>  "Nom du produit"]
            )
            ->add("productDescription", TextType::class,
                ["label"    =>  "Description du produit"]
            )
            ->add("productPrice", MoneyType::class,
                ["label"    =>  "Prix du produit"]
            )
            ->add("productSale", NumberType::class,
                ["label"    =>  "Promotion du produit"]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ["data_class"   =>  Products::class]
        );
    }

}
