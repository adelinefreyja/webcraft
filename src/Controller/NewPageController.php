<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewPageController extends Controller
{
	/**
	* @Route("/craft/newpage", name="newpage")
	*/
	public function new(Request $request)
	{

        return $this->render('backoffice/pages/addpage.html.twig');
	}
}