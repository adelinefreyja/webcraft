<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\WebsiteInfo;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactOptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("optionname", HiddenType::class, 
                [   "data"  =>  "contact"
                 ]
            )
            ->add('optionvalue', HiddenType::class,
                [   "data"  =>  "Activation module" ]
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