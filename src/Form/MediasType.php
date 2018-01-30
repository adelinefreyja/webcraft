<?php

namespace App\Form;

use App\Entity\Medias;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MediasType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("mediaName", TextType::class,
                ["label"    =>  "Nom du media"]
            )
            ->add("mediaDescription", TextType::class,
                ["label"    =>  "Description du media"]
            )
            ->add("mediaType", ChoiceType::class,
                array(
                    "label"     =>  "Type de fichier",
                    "choices"   =>
                        array(
                            "Audio" =>  "audio",
                            "Vidéo" =>  "video",
                            "Image" =>  "image",
                            "PDF"   =>  "pdf"
                        )
                )
            )
            ->add("mediaSrc", FileType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ["data_class"   =>  Medias::class]
        );
    }

}
