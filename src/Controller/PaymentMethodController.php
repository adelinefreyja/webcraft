<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Payment;
use App\Entity\Contact;
use App\Form\PaymentType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentMethodController extends Controller
{
	/**
	* @Route("/craft/settings/shop/payment", name="paymentmethods")
	*/
	public function managePaymentMethodsAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == "0") {
            return $this->redirectToRoute('dashboard');
        }

        $rep2 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep2->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Payment::class);
        $payments = $rep->findAll();

        $payment = new Payment();
        $form = $this->createForm(PaymentType::class, $payment);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($payment);
            $em->flush();
            $this->addFlash(
                'success',
                "Méthode de paiement créée !"
            );
            return $this->redirectToRoute('paymentmethods');
        }

        return $this->render('backoffice/settings/payments.html.twig',
            ["sitetype" =>  $query, "payments" => $payments, "form" => $form->createView(), "messages"  =>  $query2]
        );
	}

    /**
    * @Route("/craft/settings/shop/payment/edit/{id}", name="editpayment")
    */
    public function editPaymentMethodAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep2 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep2->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Payment::class);
        $payments = $rep->findAll();

        $payment = $this->getDoctrine()
            ->getManager()
            ->getRepository(Payment::class)
            ->find($id)
        ;

        $form = $this->createForm(PaymentType::class, $payment);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash(
                'success',
                "Méthode de paiement mise à jour !"
            );
            return $this->redirect($this->generateUrl('paymentmethods'));
        }

        return $this->render('backoffice/settings/editpayment.html.twig', ["sitetype" =>  $query, "payments" => $payments, "form" => $form->createView(), "payment" => $payment, "messages"  =>  $query2]
        );
    }
    /**
    * @Route("/craft/settings/shop/payment/remove/{id}", name="deletepayment")
    */
    public function deletePaymentMethodAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $payment = $em->getRepository(Payment::class)
            ->find($id);
        $em->remove($payment);
        $em->flush();
        $this->addFlash(
            'success',
            'La méthode de paiement a bien été supprimée'
        );
        return $this->redirect($this->generateUrl('paymentmethods'));
    }
}
