<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use App\Form\AddPageType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class NewPageController extends Controller
{
	/**
	* @Route("/craft/newpage", name="newpage")
	*/
	public function addPageAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
        
        $user = $this->getUser();
        $user->getId();

        $page = new Pages();
        $form = $this->createForm(AddPageType::class, $page);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page->setUserId($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('newpage');
        }

        return $this->render('backoffice/pages/addpage.html.twig',
            ["sitetype" =>  $query, 'form' => $form->createView()]
        );
	}
}
