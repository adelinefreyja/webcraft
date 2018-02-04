<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Contact;
use App\Entity\Design;
use App\Form\DesignType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DesignController extends Controller
{
	/**
	* @Route("/craft/design", name="design")
	*/
	public function designOptionsAction(Request $request) {

$_SESSION["sitetype"] = "";

        if (!isset($_SESSION["sitetype"]) || empty($_SESSION["sitetype"])) {
            $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
            $query = $repository->findOneBy(
                ["sitetype" =>  "2"]
            );

            if ($query) {

                $_SESSION["sitetype"] = "2";
            } else {

                $_SESSION["sitetype"] = "1";
            }
            
        }
        
        
        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $design = new Design();
        $form = $this->createForm(DesignType::class, $design);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($design);
            $em->flush();
            
            return $this->redirectToRoute('design');

        }

        return $this->render('backoffice/customs/design.html.twig',
            ["sitetype" =>  $query, "messages"  =>  $query2, "form" => $form->createView()]
        );
	}
}
