<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Products;
use App\Entity\Pages;
use App\Entity\Orders;
use App\Entity\Medias;
use App\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminDashboardController extends Controller
{
	/**
	* @Route("/craft", name="dashboard")
	*/
	public function displayDashboardAction(Request $request) {

	    $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
	    $query = $repository->findOneBy(
	        ["sitetype" =>  "2"]
        );

        $repository2 = $this->getDoctrine()->getManager()->getRepository(Products::class);
        $query2 = $repository2->findAll();

        $repository3 = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $query3 = $repository3->findAll();

        $repository4 = $this->getDoctrine()->getManager()->getRepository(Orders::class);
        $query4 = $repository4->findAll();

        $repository5 = $this->getDoctrine()->getManager()->getRepository(Medias::class);
        $query5 = $repository5->findAll();

        $repository6 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query6 = $repository6->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );
        

        return $this->render(
            'backoffice/dashboard.html.twig',
            [
                "sitetype"      =>  $query,
                "products"      =>  $query2,
                "pages"    		=>  $query3,
                "orders"      	=>  $query4,
                "medias"        =>  $query5,
                "messages"      =>  $query6
            ]
        );
	}

		public function index()
	{
		$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    	$user = $this->getUser();
	    return new Response('Bienvenue, '.$user->getUserFirstName());
	}
}
