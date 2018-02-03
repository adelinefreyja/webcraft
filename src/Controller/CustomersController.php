<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Customers;
use App\Entity\User;
use App\Entity\UserAddress;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CustomersController extends Controller
{
	/**
	* @Route("/craft/customers", name="customers")
	*/
	public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
				$queryCustomers = $this->getDoctrine()->getManager()->getRepository(Customers::class);
        $customers = $queryCustomers->findAll();

				$queryUser = $this->getDoctrine()->getManager()->getRepository(User::class);
        $user = $queryUser->findAll();

				$queryUserAddress = $this->getDoctrine()->getManager()->getRepository(UserAddress::class);
        $userAddress = $queryUserAddress->findAll();

        return $this->render('backoffice/customers/customers.html.twig',
            [ "customers" => $customers,
						  "user" => $user,
							"userAddress" => $userAddress,
							"sitetype" =>  $query]
        );
	}
}
