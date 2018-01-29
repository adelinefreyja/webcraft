<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminDashboardController extends Controller
{
	/**
	* @Route("/craft", name="dashboard")
	*/
	public function new(Request $request) {

	    $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
	    $query = $repository->findOneBy(
	        ["sitetype" =>  "2"]
        );

        return $this->render('backoffice/dashboard.html.twig',
            ["sitetype" =>  $query]
        );
	}

		public function index()
	{
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$user = $this->getUser();
	    return new Response('Bienvenue, '.$user->getUserFirstName());
	}
}
