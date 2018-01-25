<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminDashboardController extends Controller
{
	/**
	* @Route("/craft", name="dashboard")
	*/
	public function new(Request $request)
	{

        return $this->render('backoffice/index.html.twig');
	}
}
