<?php
namespace App\Controller;

use App\Entity\Pages;
use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\ContactType;
use App\Form\NewsletterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SitePublicController extends Controller
{


	/**
	* @Route("/ColoShop/{category_name}", name="sitepublic")
	*/
    public function publicPage(Request $request, $category_name){
      
        $repository = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $query = $repository->findOneBy(
            ['category_name' => $category_name]
        );
            /* NEWSLETTER */
        $newsletter = new Newsletter();
                $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);
                $newsletterForm->handleRequest($request);

                if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($newsletter);
                    $em->flush();
                    $this->addFlash(
                        'success',
                        "Email enregistrer!"
                    );
                    $query = $repository->findOneBy(
                        ['category_name' => "Accueil"]
                    );
                    return $this->redirectToRoute('sitepublic',["category_name" =>  $query]);
                } 

        if($category_name == "Accueil"){
            return $this->render('ColoShop\index.html.twig',
            ["Pages" =>  $query,  'newsletterform' => $newsletterForm->createView(),]
            );

        }elseif ($category_name == "Contact") {

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
                    $query = $repository->findOneBy(
                        ['category_name' => "Accueil"]
                    );
                    return $this->redirectToRoute('sitepublic',["category_name" =>  $query]);
                }
        
               
                return $this->render('ColoShop\contact.html.twig',
                    ["Pages" =>  $query, 'contactform' => $contactForm->createView(), "messages"  =>  $query2 , 'newsletterform' => $newsletterForm->createView(),]
                );

        }
        elseif($category_name == "Shop"){
            return $this->render('ColoShop\categories.html.twig',
            ["Pages" =>  $query,  'newsletterform' => $newsletterForm->createView(),]
            );
        }
        elseif($category_name == "Pages"){
            return $this->render('ColoShop\single.html.twig',
            ["Pages" =>  $query ,  'newsletterform' => $newsletterForm->createView(),]
            );
        }
        else {
            $query = $repository->findOneBy(
                ['category_name' => "Accueil"]
            );
            return $this->redirectToRoute('sitepublic',
                ["category_name" =>  $query]
            );
        }

    }

}
