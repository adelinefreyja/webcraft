<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use App\Form\AddPageType;
use App\Form\EditPageType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ManagePagesController extends Controller
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

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        $page = new Pages();
        $form = $this->createForm(AddPageType::class, $page);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $page->setUserId($user->getId());
            $page->setPageDate(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('newpage');
        }

        return $this->render('backoffice/pages/addpage.html.twig',
            ["sitetype" =>  $query, 'form' => $form->createView(), "pages" => $pages]
        );
    }

	/**
	* @Route("/craft/pages/manage", name="managepages")
	*/
	public function displayPagesAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        return $this->render('backoffice/pages/managepages.html.twig',
            ["sitetype" =>  $query, "pages" => $pages]
        );
	}

    /**
     * @Route("/craft/pages/edit/{id}", name="editpage")
     */
    public function editUserAction(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $getPages = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $getPages->findAll();

        $page = $this->getDoctrine()
            ->getManager()
            ->getRepository(Pages::class)
            ->find($id)
        ;

        $form = $this->createForm(EditPageType::class, $page);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash(
                'success',
                "Page mise à jour !"
            );
            return $this->redirect($this->generateUrl('managepages'));
        }

        return $this->render('backoffice/pages/editpages.html.twig', ["sitetype" =>  $query, 'form' => $form->createView(), "page" => $page, 'pages' => $pages]
        );
    }

    /**
     * @Route("/craft/pages/remove/{id}", name="deletepage")
     */
    public function deleteUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $page = $em->getRepository(Pages::class)
            ->find($id);
        $em->remove($page);
        $em->flush();
        $this->addFlash(
            'success',
            'Page supprimée'
        );
        return $this->redirect($this->generateUrl('managepages'));
    }
}
