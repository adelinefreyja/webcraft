<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class GeneralFrontController extends Controller
{

	/**
    * @Route("/", name="index")
    */
	public function index()	{

	    try {
            $repository4 = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
            $query4 = $repository4->findOneBy([
                    "sitetype"	=>	"1"
                ]
            );

            $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
            $query = $repository->findOneBy([
                    "sitetype"	=>	"2"
                ]
            );
        } catch (\Exception $e) {
            $response = $this->forward('App\Controller\DatabaseController::registerAction');

            return $response;
        }


        if($query4){
            $response = $this->forward('App\Controller\ImperialController::displayIndexAction');

            return $response;

		} else if($query){
            $response = $this->forward('App\Controller\SitePublicController::publicPage', ["category_name" => "Accueil"]);

            return $response;
		} else {
            $response = $this->forward('App\Controller\DatabaseController::registerAction');

            return $response;
        }
	}
}
