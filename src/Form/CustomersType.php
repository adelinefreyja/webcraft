 <?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use App\Entity\Customers;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomersType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
           ->add('userLandphone', IntegerType::class, 
                [ 'label' =>  'Téléphone Fixe']
            )
            ->add('userMobilephone', IntegerType::class, 
                [ 'label' =>  'Téléphone Portable']
            )
        ;   
    }

    public function configureOptions(OptionsResolver $resolver) {

        $resolver->setDefaults(
           ['data_class' => Customers::class,
        ]
        );
    }
}