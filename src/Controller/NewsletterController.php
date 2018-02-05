<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Form\NewsletterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class NewsletterController extends Controller
{
    /**
    * @Route("/craft/settings/newsletter", name="BackofficeNewsletter")
    */
    public function displayNewsletterPageAction(Request $request) {

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
        
        $repositoryNewsletter = $this->getDoctrine()->getManager()->getRepository(Newsletter::class);
        $queryNewsletter = $repositoryNewsletter->findAll();

        return $this->render('backoffice/settings/newsletter.html.twig',
            ["sitetype" =>  $query, "messages"  =>  $query2, "newsletter" =>  $queryNewsletter]
        );
    }
}
