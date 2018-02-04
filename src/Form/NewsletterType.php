<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Newsletter;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewsletterType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add("emailValue", EmailType::class, 
                [   "label" => "Votre Email" ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
            ['data_class' => Newsletter::class]
        );
    }
}