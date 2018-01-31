<?php
namespace App\Controller;

use App\Entity\User;
use App\Entity\WebsiteInfo;
use App\Form\UserModifyInfoType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserAccountController extends Controller
{
	/**
	* @Route("/craft/account", name="user_account")
	*/
	public function accountAction(Request $request, UserPasswordEncoderInterface $passwordEncoder) {

		$repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $user = $this->getUser();
        $form = $this->createForm(UserModifyInfoType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPassword());
            $user->setPassword($password);

            $file = $form["user_profile_picture"]->getData();

            try {
                $fileName = $user->getId() . '.' . $file->guessExtension();
            } catch (\Exception $e) {
                $fileName = $user->getId() . '.' . $file->getExtension();
            }

            $file->move(
                $this->getParameter('user_directory'),
                $fileName
            );

            $user->setUserProfilePicture("img/user_pp/" . $fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('user_account');
    	}

        return $this->render('backoffice/user/account.html.twig',
            array(
                "sitetype"          =>  $query, "form" => $form->createView()
            )
        );
	}

	public function index()
	{
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$user = $this->getUser();
	    return new Response('Bienvenue, '.$user_first_name->getUserFirstName());
	}
}
