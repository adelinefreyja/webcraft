<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShopSettingsController extends Controller
{
	/**
	* @Route("/craft/settings/shop", name="shopsettings")
	*/
	public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == "0") {
            return $this->redirectToRoute('dashboard');
        }

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        return $this->render('backoffice/settings/shopsettings.html.twig',
            ["sitetype" =>  $query, "messages"  =>  $query2]
        );
	}
}
