<?php

namespace App\Form;

use App\Entity\Shipment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ShipmentType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("shipment_method", TextType::class,
                [ "label"   =>  "Méthode d'expédition" ]
        )
            ->add("price", TextType::class,
                [   "label" =>  "Prix" ]
        )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ["data_class"     =>  Shipment::class]
        );
    }
}
