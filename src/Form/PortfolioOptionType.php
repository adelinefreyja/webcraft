<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PortfolioOptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("optionname", HiddenType::class, 
                [   "data"  =>  "portfolio"
                 ]
            )
            ->add('optionvalue', EntityType::class,
                [
                    "class" =>  Pages::class,
                    'choice_label' => 'page_name'
                ]
            )
            ->add("description", HiddenType::class, 
                [   "data" => "module" ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => WebsiteInfo::class]
        );
    }
}