<?php
namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Customers;
use App\Entity\Newsletter;
use App\Entity\Orders;
use App\Entity\Payment;
use App\Entity\Products;
use App\Entity\ProductsCategory;
use App\Entity\ProductsColors;
use App\Entity\ProductsComments;
use App\Entity\ProductsImages;
use App\Entity\ProductsSizes;
use App\Entity\ProductsTax;
use App\Entity\Sales;
use App\Entity\Shipment;
use App\Entity\UserAddress;
use App\Form\WebsiteInfoType;
use App\Entity\WebsiteInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class WebsiteInfoController extends Controller
{
    /**
     * @Route("/setup2", name="setup2")
     */
    public function websiteInfoAction(Request $request)
    {
        $WebsiteInfo = new WebsiteInfo();
        $form = $this->createForm(WebsiteInfoType::class, $WebsiteInfo);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() /*&& $form->isValid()*/) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($WebsiteInfo);
            $em->flush();

            $query = $em->createQuery("SELECT s FROM App\Entity\WebsiteInfo s WHERE s.sitetype = 2");
            $commerce = $query->getResult();

            if ($commerce) {

                $query = new Contact();
                $em->persist($query);

                $query = new Customers();
                $em->persist($query);

                $query = new Newsletter();
                $em->persist($query);

                $query = new Orders();
                $em->persist($query);

                $query = new Payment();
                $em->persist($query);

                $query = new Products();
                $em->persist($query);

                $query = new ProductsCategory();
                $em->persist($query);

                $query = new ProductsColors();
                $em->persist($query);

                $query = new ProductsComments();
                $em->persist($query);

                $query = new ProductsImages();
                $em->persist($query);

                $query = new ProductsSizes();
                $em->persist($query);

                $query = new ProductsTax();
                $em->persist($query);

                $query = new Sales();
                $em->persist($query);

                $query = new Shipment();
                $em->persist($query);

                $query = new UserAddress();
                $em->persist($query);
            }

            return $this->redirectToRoute('setup3');
        }

        return $this->render(
            'setup/setup2.html.twig',
            array('form' => $form->createView())
        );
    }
}
