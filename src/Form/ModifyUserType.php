<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ModifyUserType extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('username', TextType::class, [
                    "label" => "Pseudo"
                ])
                ->add('roles', ChoiceType::class, array(
                    'choices'  => array(
                        'Editeur' => 'ROLE_ADMIN',
                        'Administrateur' => 'ROLE_SUPER_ADMIN',
                    ),
                    'label' => "Rôle de l'utilisateur",
                    'multiple' => true
                ));
    }
                
}