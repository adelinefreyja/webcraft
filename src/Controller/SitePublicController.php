<?php
namespace App\Controller;

use App\Entity\Pages;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SitePublicController extends Controller
{
	/**
	* @Route("/ColoShop/{pageName}", name="SitePublic")
	*/
    public function publicPage(Request $request, $pageName){
      $repository = $this->getDoctrine()->getManager()->getRepository(Pages::class);
      $query = $repository->findOneBy(
        ['pageName' => $pageName]
      );

      return $this->render('ColoShop\index.html.twig',
          ["Pages" =>  $query]
      );


    }

/**
  * @Route("/ColoShop/{pageName}==contact", name="contact")
  */
    public function contactPage(Request $request, $pageName){
      $repository = $this->getDoctrine()->getManager()->getRepository(Pages::class);
      $query = $repository->findOneBy(
        ['pageName' => $pageName]
      );

      return $this->render('ColoShop\contact.html.twig',
          ["Pages" =>  $query]
      );


    }

}
