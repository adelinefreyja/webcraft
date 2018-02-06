<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Customers;
use App\Entity\User;
use App\Entity\UserAddress;
use App\Entity\Contact;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CustomersController extends Controller
{
	/**
	* @Route("/craft/customers", name="customers")
	*/
	
    public function getCustomInformations(Request $request)
        {
            $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
            $query = $repository->findOneBy(
                ["sitetype" =>  "2"]
            );

            if ($query == 0) {
                return $this->redirectToRoute('dashboard');
            }

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $em = $this->getDoctrine()->getManager();
        $rawSql = "SELECT user_first_name, user_last_name, user_email, user_address, user_zipCode, user_city, user_landPhone, user_mobilePhone FROM user, user_address, customers WHERE user.id = user_address.id AND customers.id = user.id";

        $statement = $em->getConnection()->prepare($rawSql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->render('backoffice/customers/customers.html.twig',
        [
            "messages" => $query2,
            "sitetype" => $query,
            "customers" => $result
        ]
        );
    }
}
