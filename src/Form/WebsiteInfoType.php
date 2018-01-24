<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\WebsiteInfo;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class WebsiteInfoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("optionname", TextType::class,["label"    =>  "Nom du Site"])
            ->add("optionvalue", TextType::class,["label"    =>  "Description"])
            ->add("sitetype", ChoiceType::class,
                [
                    "label" => "Type de Site",
                    "choices"   =>  [
                        "E-commerce" =>  true,
                        "Vitrine" =>  true
                    ],
                    "expanded"  =>  true
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => WebsiteInfo::class]
        );
    }
}
