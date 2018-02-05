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
            $toEmpty= $this->getDoctrine()->getManager()->getRepository(Menu::class);
            $oldMenu = $toEmpty->findAll();

            $em = $this->getDoctrine()->getManager();


            foreach ($oldMenu as $del) {
                $em->remove($del);
                $em->flush();
            }

            $newMenu = explode(",", $_POST["menu"]["pageName"]);

            for ($i = 0; $i < 5; $i++) {
                $menu = new Menu();
                $menu->setPageName($newMenu[$i]);
                $menu->setMenuRank($i + 1);
                $em->persist($menu);
                $em->flush();
            }

             return $this->redirect($this->generateUrl('menus'));
        }


        return $this->render('backoffice/customs/menus.html.twig',
            [
                "sitetype" =>  $query,
                "pages" => $pages,
                "messages"  =>  $query2,
                "form" => $form->createView()
            ]
            // , "form3" => $form3->createView(), "form4" => $form4->createView(), "form5" => $form5->createView()
        );
	}
}
