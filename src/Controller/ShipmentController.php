<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Shipment;
use App\Entity\Contact;
use App\Form\ShipmentType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShipmentController extends Controller
{
	/**
	* @Route("/craft/settings/shop/shipment", name="shipments")
	*/
	public function manageShipmentMethodsAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == "0") {
            return $this->redirectToRoute('dashboard');
        }

        $rep1 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep1->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Shipment::class);
        $shipments = $rep->findAll();

        $shipment = new Shipment();
        $form = $this->createForm(ShipmentType::class, $shipment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($shipment);
            $em->flush();
            $this->addFlash(
                'success',
                "Méthode d'expédition créée !"
            );
            return $this->redirectToRoute('shipments');
        }

        return $this->render('backoffice/settings/shipments.html.twig',
            ["sitetype" =>  $query, 
            "shipments" => $shipments, 
            "form" => $form->createView(), 
            "messages"  =>  $query2
            ]
        );
	}

    /**
    * @Route("/craft/settings/shop/shipment/edit/{id}", name="editshipment")
    */
    public function editShipmentMethodAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == 0) {
            return $this->redirectToRoute('dashboard');
        }

        $rep1 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep1->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Shipment::class);
        $shipments = $rep->findAll();

        $shipment = $this->getDoctrine()
            ->getManager()
            ->getRepository(Shipment::class)
            ->find($id)
        ;

        $form = $this->createForm(ShipmentType::class, $shipment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash(
                'success',
                "Méthode d'expédition mise à jour !"
            );
            return $this->redirect($this->generateUrl('shipments'));
        }

        return $this->render('backoffice/settings/editshipment.html.twig', 
            [
                "sitetype"  =>  $query, 
                "shipments" =>  $shipments, 
                "form"      =>  $form->createView(), 
                "shipment"  =>  $shipment, 
                "messages"  =>  $query2
            ]
        );
    }
    /**
    * @Route("/craft/settings/shop/shipment/remove/{id}", name="deleteshipment")
    */
    public function deleteShipmentMethodAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == 0) {
            return $this->redirectToRoute('dashboard');
        }

        $em = $this->getDoctrine()->getManager();
        $shipment = $em->getRepository(Shipment::class)
            ->find($id);
        $em->remove($shipment);
        $em->flush();
        $this->addFlash(
            'success',
            'La méthode d\'expédition a bien été supprimée'
        );
        return $this->redirect($this->generateUrl('shipments'));
    }
}
