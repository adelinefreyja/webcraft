<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\WebsiteInfo;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogoModifyType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("optionvalue", FileType::class,
                [
                    "data_class"    =>  null
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
