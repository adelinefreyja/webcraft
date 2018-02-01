<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
	/**
	* @Route("/craft/menu", name="menus")
	*/
	public function createMenuAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        return $this->render('backoffice/customs/menus.html.twig',
            ["sitetype" =>  $query, "pages" => $pages]
        );
	}
}
