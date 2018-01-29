<?php
namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminDashboardController extends Controller
{
	/**
	* @Route("/craft", name="dashboard")
	*/
	public function new(Request $request)
	{

        return $this->render('backoffice/dashboard.html.twig');
	}

		public function index()
	{
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$user = $this->getUser();
	    return new Response('Bienvenue, '.$user->getUserFirstName());
	}
}