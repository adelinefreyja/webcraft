<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\ProductsCategory;
use App\Entity\Products;
use App\Entity\Contact;
use App\Form\ProductsCategoriesType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductsCategoriesController extends Controller
{
	/**
	* @Route("/craft/products/categories", name="productcategories")
	*/
	public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        if ($query == "0") {
            return $this->redirectToRoute('dashboard');
        }

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $queryCategories = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
        $categories = $queryCategories->findAll();

        $queryProducts = $this->getDoctrine()->getManager()->getRepository(Products::class);
        $products = $queryProducts->findAll();

        $cat = new ProductsCategory();
        $form = $this->createForm(ProductsCategoriesType::class, $cat);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($cat);
            $em->flush();
            $this->addFlash(
                'success',
                "Catégorie créée !"
            );
            return $this->redirectToRoute('productcategories');
        }

        return $this->render('backoffice/products/productcategories.html.twig',
            [
                "sitetype"      =>  $query,
                "categories"    =>  $categories,
                "products"      =>  $products,
                "form"          =>  $form->createView(), 
                "messages"  =>  $query2

            ]
        );
	}

    /**
     * @Route("/craft/products/categories/edit/{id}", name="editcat")
     */
    public function editCatAction(Request $request, $id) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
        $cats = $rep->findAll();

        $rep2 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep2->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $cat = $this->getDoctrine()
            ->getManager()
            ->getRepository(ProductsCategory::class)
            ->find($id)
        ;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["CategoryEdit"]) || empty($_SESSION["CategoryEdit"])) {

            $_SESSION["CategoryEdit"] = [];
            $_SESSION["CategoryEdit"]["pastValue"] = $cat->getCategoryValue();
        }

        $form = $this->createForm(ProductsCategoriesType::class, $cat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $em = $this->getDoctrine()->getManager();

            $findIt = $rep->findBy(
                ["categoryValue"    =>  $_SESSION["CategoryEdit"]["pastValue"]]
            );

            $_SESSION["CategoryEdit"] = [];

            foreach ($findIt as $query) {
                $query->setCategoryValue($cat->getCategoryValue());
            }

            $em->flush();
            $this->addFlash(
                'success',
                "Catégorie mise à jour !"
            );
            return $this->redirect($this->generateUrl('productcategories'));
        }

        return $this->render('backoffice/products/editcategories.html.twig',
            [
                "sitetype" =>  $query,
                "categories" => $cats,
                "form" => $form->createView(),
                "cat" => $cat,
                "messages"  =>  $query2
            ]
        );
    }
    /**
     * @Route("/craft/products/categories/delete/{id}", name="deletecat")
     */
    public function deleteCatAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $em2 = $em->getRepository(ProductsCategory::class);

        $cat = $em2->find($id);

        $findIt = $em2->findBy(
            ["categoryValue"    =>  $cat->getCategoryValue()]
        );

        foreach ($findIt as $query) {
            $em->remove($query);
        }

        $em->flush();

        $this->addFlash(
            'success',
            'La catégorie a bien été supprimée'
        );

        return $this->redirect($this->generateUrl('productcategories'));
    }
}
