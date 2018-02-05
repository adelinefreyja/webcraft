<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use App\Entity\Menu;
use App\Entity\Contact;
use App\Form\MenuType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MenuController extends Controller
{
	/**
	* @Route("/craft/menu", name="menus")
	*/
	public function createMenuAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
        
        $rep2 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep2->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        $menu = new Menu();
        $form = $this->createForm(MenuType::class, $menu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';
            $menu->setMenuRank(1);
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu);
            $em->flush();
            // return $this->redirect($this->generateUrl('menus'));
        }

        $menu2 = new Menu();
        $form2 = $this->createForm(MenuType::class, $menu2);
        $form2->handleRequest($request);
        if ($form2->isSubmitted() && $form2->isValid())
        {
            echo '<pre>';
            var_dump($_POST);
            echo '</pre>';
            $menu2->setMenuRank(2);
            $em = $this->getDoctrine()->getManager();
            $em->persist($menu2);
            $em->flush();
            // return $this->redirect($this->generateUrl('menus'));
        }

        // $menu3 = new Menu();
        // $form3 = $this->createForm(MenuType::class, $menu3);
        // $form3->handleRequest($request);
        // if ($form3->isSubmitted() && $form3->isValid())
        // {
        //     $menu3->setMenuRank(3);
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($menu3);
        //     $em->flush();
        //     return $this->redirect($this->generateUrl('menus'));
        // }

        // $menu4 = new Menu();
        // $form4 = $this->createForm(MenuType::class, $menu4);
        // $form4->handleRequest($request);
        // if ($form4->isSubmitted() && $form4->isValid())
        // {
            
        //     $em = $this->getDoctrine()->getManager();
        //     $menu4->setMenuRank(4);
        //     $em->persist($menu4);
        //     $em->flush();
        //     return $this->redirect($this->generateUrl('menus'));
        // }

        // $menu5 = new Menu();
        // $form5 = $this->createForm(MenuType::class, $menu5);
        // $form5->handleRequest($request);
        // if ($form5->isSubmitted() && $form5->isValid())
        // {
        //     $menu5->setMenuRank(5);
        //     $em = $this->getDoctrine()->getManager();
        //     $em->persist($menu5);
        //     $em->flush();
        //     return $this->redirect($this->generateUrl('menus'));
        // }

        return $this->render('backoffice/customs/menus.html.twig',
            ["sitetype" =>  $query, "pages" => $pages, "messages"  =>  $query2, "form" => $form->createView(), "form2" => $form2->createView()]
            // , "form3" => $form3->createView(), "form4" => $form4->createView(), "form5" => $form5->createView()
        );
	}
}
