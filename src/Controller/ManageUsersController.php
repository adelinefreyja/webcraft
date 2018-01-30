<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageUsersController extends Controller
{
	/**
	* @Route("/craft/settings/users/manage", name="manageusers")
	*/
	public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        return $this->render('backoffice/settings/manageusers.html.twig',
            ["sitetype" =>  $query]
        );
	}
}
