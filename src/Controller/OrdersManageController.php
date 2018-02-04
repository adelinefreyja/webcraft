<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Orders;
use App\Entity\Contact;
use App\Form\ModifyOrderType;
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

		$rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

		return $this->render('backoffice/orders/manageorders.html.twig',
			[ "orders" => $orders,
						"sitetype" =>  $query, 
						"messages"  =>  $query2
			]
		);
	}

	/**
	 * @Route("/craft/manageorders/edit/{id}", name="editorder")
	 */
	public function editOrderAction(Request $request, $id)
	{

			$repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
			$query = $repository->findOneBy(
					["sitetype" =>  "2"]
			);

			$getOrders = $this->getDoctrine()->getManager()->getRepository(Orders::class);
			$orders = $getOrders->findAll();

			$order = $this->getDoctrine()
					->getManager()
					->getRepository(Orders::class)
					->find($id)
			;

			$rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        	$query2 = $rep->findBy(
                [
                    "status"    =>  "nonlu"
                ]
            );

			$form = $this->createForm(ModifyOrderType::class, $order);
			$form->handleRequest($request);
			if ($form->isSubmitted() && $form->isValid())
			{
					$em = $this->getDoctrine()->getManager();
					$em->flush();
					$this->addFlash(
							'success',
							"Commande mis à jour !"
					);
					return $this->redirect($this->generateUrl('manageorders'));
			}

			return $this->render('backoffice/orders/editorder.html.twig', ["sitetype" =>  $query, 'form' => $form->createView(), "orders" => $orders, "messages"  =>  $query2]
			);
	}
	/**
	 * @Route("/craft/manageorders/remove/{id}", name="deleteorder")
	 */
	public function deleteOrderAction(Request $request, $id)
	{
			$em = $this->getDoctrine()->getManager();
			$order = $em->getRepository(Orders::class)
					->find($id);
			$em->remove($order);
			$em->flush();
			$this->addFlash(
					'success',
					'La commande a bien été supprimé'
			);
			return $this->redirect($this->generateUrl('manageorders'));
	}
}
