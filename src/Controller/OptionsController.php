<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use App\Form\Contact;
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
        $query2 = $rep2->findAll();

        $user = $this->getUser();
        $user->getId();

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        $fetchContactMod = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $contactMod = $fetchContactMod->findOneBy(
            ["optionname" => "contact",
            "description" => "module"
            ]
        );

        $contactMod = new WebsiteInfo();
        $activContact = $this->createForm(ContactOptionType::class, $contactMod);

        $activContact->handleRequest($request);
        if ($activContact->isSubmitted() && $activContact->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($contactMod);
            $em->flush();
            $this->addFlash(
                'success',
                "Module activé !"
            );
            return $this->redirectToRoute('options');
        }


        return $this->render('backoffice/customs/options.html.twig',
            ["sitetype" =>  $query, "activContact" => $activContact->createView(), "contact" => $contactMod, "messages"  =>  $query2]
        );
	}


}
