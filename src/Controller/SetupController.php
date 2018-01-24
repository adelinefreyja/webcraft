<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SetupController extends Controller
{
  /**
	* @Route("/setup", name="setup")
	*/
    public function new(Request $request)
    {
        // create a task and give it some dummy data for this example
        $user = new User();
        $user->setTask('Write a blog post');
        $user->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($user)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();

        return $this->render('backoffice/setup.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
