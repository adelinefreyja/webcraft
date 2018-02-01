<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\PageCategories;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddPageCategoryType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("category_name", TextType::class, 
                [   "label" => "Le nom de votre catégorie" ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => PageCategories::class]
        );
    }
}