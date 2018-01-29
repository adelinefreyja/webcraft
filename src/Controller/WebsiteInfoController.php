<?php
namespace App\Controller;

use App\Entity\Ecommerce;
use App\Entity\User;
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

        try {
            $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
            $query = $repository->findAll();

            if (!empty($query)) {
                return $this->redirectToRoute('login');
            }
        } catch (\Exception $e) {
            return $this->redirectToRoute('setup');
        }

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

                $create = new Ecommerce();
                $create->createEcommerce();

            }

            return $this->redirectToRoute('setup3');
        }

        return $this->render(
            'setup/setup2.html.twig',
            array('form' => $form->createView())
        );
    }
}
