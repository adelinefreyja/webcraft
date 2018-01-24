<?php
// src/Controller/DefaultController.php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends Controller {

  /**
	* @Route("/", name="setup")
	*/
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        // create a task and give it some dummy data for this example
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('dashboard');
        }

        return $this->render('setup/setup.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
