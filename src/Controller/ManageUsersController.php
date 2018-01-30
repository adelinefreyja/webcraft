<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\User;
use App\Form\NewUserType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ManageUsersController extends Controller
{
	/**
	* @Route("/craft/settings/users/manage", name="manageusers")
	*/
	public function manageAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('manageusers');
        }

        $getUsers = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $getUsers->findAll();


        return $this->render('backoffice/settings/manageusers.html.twig',
            ["sitetype" =>  $query, 'form' => $form->createView(), "users" => $users]
        );
	}
}
