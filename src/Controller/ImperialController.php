<?php
namespace App\Controller;

use App\Entity\Pages;
use App\Entity\Medias;
use App\Entity\WebsiteInfo;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImperialController extends Controller
{
	/**
	* @Route("/", name="index")
	*/
	public function displayIndexAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $query = $repository->findAll();

        $repository2 = $this->getDoctrine()->getManager()->getRepository(Medias::class);
        $query2 = $repository2->findAll();

        $repository3 = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query3 = $repository3->findOneBy(
	        ["optionname" =>  "contact"]
	    );

        $repository4 = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query4 = $repository4->findOneBy(
            ["description" => "siteinfo"]
        );

        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact->setMessageDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            return $this->redirectToRoute('contact');

        }
        
        return $this->render(
            'front/Imperial/index.html.twig',
            [
                "pages"    		=>  $query,
                "medias"        =>  $query2,
                "contact"		=>	$query3,
                "siteinfo"      =>  $query4,
                "contactform"   =>  $contactForm->createView()
            ]
        );
	}

    /**
    * @Route("/#contact", name="contact")
    */
    public function displayContactOptionAction(Request $request) {

        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact->setMessageDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            
            return $this->addFlash(
                'success',
                "Message envoyé !")
            ;
        }
        
        return $this->render(
            'front/Imperial/contact.html.twig',
            [
                "contactform"   =>  $contactForm->createView()
            ]
        );
    }
}
