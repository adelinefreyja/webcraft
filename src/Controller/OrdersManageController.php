<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Orders;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OrdersManageController extends Controller
{
	/**
	* @Route("/craft/manageorders", name="manageorders")
	*/
	public function new(Request $request) {

				$repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
				$query = $repository->findOneBy(
						["sitetype" =>  "2"]
				);

				$queryOrders = $this->getDoctrine()->getManager()->getRepository(Orders::class);
				$orders = $queryOrders->findAll();

				return $this->render('backoffice/orders/manageorders.html.twig',
						[ "orders" => $orders,
						"sitetype" =>  $query]
				);
	}
}
