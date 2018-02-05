<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use App\Entity\Contact;
use App\Form\ContactOptionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OptionsController extends Controller
{
	/**
	* @Route("/craft/options", name="options")
	*/
	public function displayOptionsAction(Request $request) {

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

        $user = $this->getUser();
        $user->getId();

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        $fetchContactMod = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $contactMod = $fetchContactMod->findOneBy(
            ["optionname" => "contact",
             "description"  =>  "module",
            ]   
        );

        $modId = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $mod = $modId->findAll();

        $contact = new WebsiteInfo();
        $activContact = $this->createForm(ContactOptionType::class, $contact);

        $activContact->handleRequest($request);
        if ($activContact->isSubmitted() && $activContact->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash(
                'success',
                "Module activé !"
            );
            return $this->redirectToRoute('options');
        }


        return $this->render('backoffice/customs/options.html.twig',
            ["sitetype" =>  $query, "activContact" => $activContact->createView(), "contact" => $contactMod, "messages"  =>  $query2, "mod" => $mod]
        );
	}

    /**
    * @Route("/craft/options/disable/{id}", name="disablemodule")
    */
    public function disableModuleAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $mod = $em->getRepository(WebsiteInfo::class)
            ->findOneBy(['id' => $id]);
        $em->remove($mod);
        $em->flush();

        return $this->redirect($this->generateUrl('options'));
    }
}
