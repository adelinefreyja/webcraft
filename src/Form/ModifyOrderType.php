<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class ModifyOrderType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('orderStatus', ChoiceType::class, array(
                    'choices'  => array(
                        'Attente' => 'Attente',
                        'En cours d\'expédition' => 'En cours d\'expédition',
                        'Expédier' => 'Expédier',
                    ),
                    'label' => "Status de la commande",
                    
                ));
    }

}
