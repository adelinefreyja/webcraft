<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Pages;
use App\Entity\PageCategories;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditPageType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("page_name", TextType::class, 
                [   "label" => "Le nom de votre page" ]
            )
            ->add("page_title", TextType::class, 
                [   "label" => "Le titre de votre page" ]
            )
            ->add("page_content", CKEditorType::class, 
                [   "label" => "Votre contenu" ]
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
            ->add("category_name", EntityType::class,
                [
                    "class" =>  PageCategories::class,
                    'choice_label' => 'category_name'
                ]
            )
            ->add('page_date', DateType::class, [
                'label' =>  'Date de création',
                'disabled'  => true,
                'widget'    => 'single_text'
                ]
            )
            ->add('page_modified', DateType::class, [
                'label' =>  'Date de modification',
                'data' => new \DateTime('now'),
                'disabled'  => true,
                'widget'    => 'single_text'
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