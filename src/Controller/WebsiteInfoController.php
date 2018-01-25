<?php
namespace App\Controller;

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

          return $this->redirectToRoute('setup3');
      }
      return $this->render(
          'setup/setup2.html.twig',
          array('form' => $form->createView())
      );
    }
}
