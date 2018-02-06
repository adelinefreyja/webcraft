<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller
{
    /**
    * @Route("/contact", name="contactpage")
    */
    public function displayContactPageAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );
        
        $user = $this->getUser();
        $user->getId();

        $contact = new Contact();
        $contactForm = $this->createForm(ContactType::class, $contact);

        $contactForm->handleRequest($request);
        if ($contactForm->isSubmitted() && $contactForm->isValid()) {
            $contact->setMessageDate(new \DateTime('now'));
            $em = $this->getDoctrine()->getManager();
            $em->persist($contact);
            $em->flush();
            $this->addFlash(
                'success',
                "Message envoyé !"
            );
            return $this->redirectToRoute('contactpage');
        }

        return $this->render('front/contact.html.twig',
            ["sitetype" =>  $query, 'contactform' => $contactForm->createView(), "messages"  =>  $query2]
        );
    }
}
