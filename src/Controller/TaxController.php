<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\ProductsTax;
use App\Entity\Contact;
use App\Form\ProductsTaxType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaxController extends Controller
{
	/**
	* @Route("/craft/settings/shop/tax", name="managetaxes")
	*/
	public function manageTaxAction(Request $request) {

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

        $rep = $this->getDoctrine()->getManager()->getRepository(ProductsTax::class);
        $taxes = $rep->findAll();

        $tax = new ProductsTax();
        $form = $this->createForm(ProductsTaxType::class, $tax);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($tax);
            $em->flush();
            $this->addFlash(
                'success',
                "Taxe créée !"
            );
            return $this->redirectToRoute('managetaxes');
        }

        return $this->render('backoffice/settings/taxes.html.twig',
            [
                "sitetype" =>  $query, 
                "taxes" => $taxes, 
                "form" => $form->createView(), 
                "messages"  =>  $query2
            ]
        );
	}

    /**
    * @Route("/craft/settings/shop/tax/edit/{id}", name="edittax")
    */
    public function editTaxAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep1 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep1->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(ProductsTax::class);
        $taxes = $rep->findAll();

        $tax = $this->getDoctrine()
            ->getManager()
            ->getRepository(ProductsTax::class)
            ->find($id)
        ;

        $form = $this->createForm(ProductsTaxType::class, $tax);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash(
                'success',
                "Taxe mise à jour !"
            );
            return $this->redirect($this->generateUrl('managetaxes'));
        }

        return $this->render('backoffice/settings/edittax.html.twig', ["sitetype" =>  $query, "taxes" => $taxes, "form" => $form->createView(), "tax" => $tax, "messages"  =>  $query2]
        );
    }
    /**
    * @Route("/craft/settings/shop/tax/remove/{id}", name="deletetax")
    */
    public function deleteTaxAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $tax = $em->getRepository(ProductsTax::class)
            ->find($id);
        $em->remove($tax);
        $em->flush();
        $this->addFlash(
            'success',
            'La taxe a bien été supprimée'
        );
        return $this->redirect($this->generateUrl('managetaxes'));
    }
}
