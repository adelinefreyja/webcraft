<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\ProductsComments;
use App\Entity\UserAddress;
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
				$repositoryProductsComments = $this->getDoctrine()->getManager()->getRepository(ProductsComments::class);
        $productsComments = $repositoryProductsComments->findAll();

				$repositoryUserAddressComment = $this->getDoctrine()->getManager()->getRepository(UserAddress::class);
        $userAddress = $repositoryUserAddressComment->findAll();

        return $this->render('backoffice/settings/managecomments.html.twig',
            ["sitetype" =>  $query,
					"userAddress" => $userAddress,
				"productsComments" => $productsComments]
        );
	}
}
