<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Orders;
use App\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrdersController extends Controller
{
	/**
	* @Route("/craft/orders", name="orders")
	*/
	public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
        
        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findAll();

		$queryOrders = $this->getDoctrine()->getManager()->getRepository(Orders::class);
        $orders = $queryOrders->findAll();

        return $this->render('backoffice/orders/orders.html.twig',
            [    "orders" => $orders,
			     "sitetype" =>  $query,
                 "messages"  =>  $query2
            ]
        );
	}
}
