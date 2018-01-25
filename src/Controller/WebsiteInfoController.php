<?php
namespace App\Controller;

use App\Form\WebsiteInfoType;
use App\Entity\WebsiteInfo;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\DatabaseController;

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

                $test = new DatabaseController;

                $test->createTablesCommerce();
            }

            return $this->redirectToRoute('setup3');
        }

        return $this->render(
            'setup/setup2.html.twig',
            array('form' => $form->createView())
        );
    }
}
