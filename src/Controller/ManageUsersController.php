<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\User;
use App\Entity\Contact;
use App\Form\NewUserType;
use App\Form\ModifyUserType;
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
        
        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findAll();

        $user = new User();
        $form = $this->createForm(NewUserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('manageusers');
        }

        $getUsers = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $getUsers->findAll();


        return $this->render('backoffice/settings/manageusers.html.twig',
            ["sitetype" =>  $query, 'form' => $form->createView(), "users" => $users, "messages"  =>  $query2]
        );
	}

    /**
     * @Route("/craft/settings/users/edit/{id}", name="edituser")
     */
    public function editUserAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findAll();

        $getUsers = $this->getDoctrine()->getManager()->getRepository(User::class);
        $users = $getUsers->findAll();

        $user = $this->getDoctrine()
            ->getManager()
            ->getRepository(User::class)
            ->find($id)
        ;

        $form = $this->createForm(ModifyUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash(
                'success',
                "Utilisateur mis à jour !"
            );
            return $this->redirect($this->generateUrl('manageusers'));
        }

        return $this->render('backoffice/settings/editusers.html.twig', ["sitetype" =>  $query, 'form' => $form->createView(), "users" => $users, "messages"  =>  $query2]
        );
    }
    /**
     * @Route("/craft/settings/users/remove/{id}", name="deleteuser")
     */
    public function deleteUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)
            ->find($id);
        $em->remove($user);
        $em->flush();
        $this->addFlash(
            'success',
            'L\'utilisateur a bien été supprimé'
        );
        return $this->redirect($this->generateUrl('manageusers'));
    }
}
