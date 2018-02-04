<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Design;
use App\Entity\WebsiteInfo;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DesignType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        if ($_SESSION["sitetype"] == "2") {

            $choice = ["E-Commerce" => "ColoShop"];
        } else {
            $choice = ["One Page"  => "Imperial",
                        "Pages multiples"   =>  "Asentus"];
        }
        
        $builder
            ->add("template_name", ChoiceType::class, 
                [   "label" => "Choisissez votre template",
                    "choices"   => $choice
                ]          
            )
            ->add("background_color", TextType::class, 
                [   "label" => "Couleur d'arrière-plan",
                    "required" =>   false
                ]
            )
            ->add("links_color", TextType::class, 
                [   "label" => "Couleur des liens",
                    "required" =>  false
                ]
            )
            ->add("text_primary_color", TextType::class, 
                [   "label" => "Couleur des titres",
                    "required" => false
                ]
            )
            ->add("text_secondary_color", TextType::class, 
                [   "label" => "Couleur des textes",
                    "required" => false
                ]
            )
            ->add("header_color", TextType::class, 
                [   "label" => "Couleur de l'en-tête",
                    "required" => false
                ]
            )
            ->add("background_img", FileType::class, 
                [   "label" => "Image d'arrière-plan",
                    "required" => false
                ]
            )
            ->add("header_img", FileType::class, 
                [   "label" => "Arrière-plan de l'en-tête",
                    "required" => false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => Design::class]
        );
    }
}