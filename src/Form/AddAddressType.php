<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\UserAddress;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddAddressType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
           ->add("userAddressname", TextType::class, 
                [   "label" => "Pseudo de votre adresse" ]
            )
            ->add("userAddress", TextType::class, 
                [   "label" => "Adresse" ]
            )
            ->add('userZipcode', IntegerType::class, 
                [ 'label' =>  'Code Postal']
            )
            ->add("userCity", TextType::class, 
                [   "label" => "Ville"  ]
            )
            ->add("userCity", TextType::class, 
                [   "label" => "Ville"  ]
            )
            ->add("userCity", TextareaType::class, 
                [   "label" => "Commentaire(facultatif)"  ]
            )
        ;   
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => UserAddress::class]
        );
    }
}