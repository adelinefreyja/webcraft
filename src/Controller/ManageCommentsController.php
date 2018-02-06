<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\ProductsComments;
use App\Entity\UserAddress;
use App\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManageCommentsController extends Controller
{
	/**
	* @Route("/craft/settings/comments/manage", name="managecomments")
	*/
	public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == "0") {
            return $this->redirectToRoute('dashboard');
        }
		
		$repositoryProductsComments = $this->getDoctrine()->getManager()->getRepository(ProductsComments::class);
        $productsComments = $repositoryProductsComments->findAll();

		$rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        return $this->render('backoffice/settings/managecomments.html.twig',
            ["sitetype" =>  $query,
				"productsComments" => $productsComments,
				"messages"  =>  $query2]
        );
	}
}
