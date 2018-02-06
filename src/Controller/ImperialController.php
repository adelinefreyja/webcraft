<?php
namespace App\Controller;

use App\Entity\Menu;
use App\Entity\Pages;
use App\Entity\Medias;
use App\Entity\WebsiteInfo;
use App\Entity\Contact;
use App\Entity\Design;
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

        $rep = $this->getDoctrine()->getManager()->getRepository(Menu::class);
        $qy = $rep->findAll();

        $repository = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $query = $repository->findAll();
        
        // $pageRank = $this->getDoctrine();
        // $getPageRank = $pageRank->getRepository(Menu::class)->orderPages('page_name');

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

        $repository5 = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query5 = $repository5->findOneBy(
            ["optionname" =>  "portfolio"]
        );

        $repository6 = $this->getDoctrine()->getManager()->getRepository(Design::class);
        $query6 = $repository6->findOneBy(
            ["templateName" => "Imperial"]
        );

        $repository7 = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query7 = $repository7->findOneBy(
            ["optionname" => "logo"]
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
                "menu"         =>  $qy,
                "pages"    		=>  $query,
                "medias"        =>  $query2,
                "contact"		=>	$query3,
                "siteinfo"      =>  $query4,
                "portfolio"     =>  $query5,
                "design"        =>  $query6,
                "logo"          =>  $query7,
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
