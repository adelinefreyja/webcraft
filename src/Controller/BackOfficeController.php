<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BackOfficeController extends Controller
{
	/**
	* This is a simple controller returning the index.html.twig view
	*
	* @return mixedfView index.html.twig
	*/
	public function indexAction()
	{
		return $this->render('base.html.twig');
	}
}