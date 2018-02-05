<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Pages;
use App\Entity\Menu;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("menu_rank", HiddenType::class )
            ->add("page_name", EntityType::class,
                [
                    "class" =>  Pages::class,
                    'choice_label' => 'page_name'
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => Menu::class]
        );
    }
}