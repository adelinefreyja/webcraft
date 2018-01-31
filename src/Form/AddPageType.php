<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Pages;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("page_name", TextType::class, 
                [   "label" => "Le nom de votre page" ]
            )
            ->add("page_title", TextType::class, 
                [   "label" => "Le titre de votre page" ]
            )
            ->add('page_date', DateType::class, [
                'label' =>  'Date de création',
                'widget' => 'single_text',
                'input' =>  'datetime',
                'data' => new \DateTime('now'),
                'disabled'  =>  true
                ]
            )
            ->add("page_content", CKEditorType::class, 
                [   "label" => "Votre contenu"  ]
            )
            ->add("page_status", ChoiceType::class,
                [
                    "label" => "Publier ?",
                    "choices"   =>  [
                        "Enregistrer en brouillon" =>  "masquer",
                        "Publier" =>  "afficher"
                    ],
                    "expanded"  =>  false
                ]
            )
            ->add("comment_status", ChoiceType::class,
                [
                    "label" => "Activer les commentaires",
                    "choices"   =>  [
                        "Oui" =>  "afficher",
                        "Non" =>  "masquer"
                    ],
                    "expanded"  =>  false
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => Pages::class]
        );
    }
}