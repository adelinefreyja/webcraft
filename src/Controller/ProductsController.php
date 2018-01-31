<?php

namespace App\Controller;

use App\Entity\ProductsImages;
use App\Entity\WebsiteInfo;
use App\Entity\ProductsCategory;
use App\Form\ProductsImagesType;
use App\Form\ProductsCategoriesType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ProductsController extends Controller {

    /**
     * @Route("/craft/addproducts", name="addproducts")
     */
    public function addProducts(Request $request) {

        $produit = new ProductsImages();
        $form = $this->createForm(ProductsImagesType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $produit->getImage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('products_directory'),
                $fileName
            );

            $produit->setImage("img/products/" . $fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $idProduit = $produit->getProduct();

            return $this->redirectToRoute('addproducts2', ["idProduit"  =>  $idProduit]);
        }

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        return $this->render(
            'backoffice/products/addproducts.twig',
            [
                'form' => $form->createView(),
                "sitetype" =>  $query
            ]
        );
    }

    /**
     * @Route("/craft/addproducts/category/{idProduit}", name="addproducts2")
     */
    public function addCategory(Request $request, $idProduit) {

        $category = new ProductsCategory();
        $form = $this->createForm(ProductsCategoriesType::class, $category);
        $form->handleRequest($request);

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
        $query2 = $repository2->findAll();

        if ($form->isSubmitted() && $form->isValid()) {

//            $category->setProduct((int)$idProduit);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $category->setProduct((int)$idProduit);
            $em->flush();

            return $this->redirectToRoute('addproducts');
        }

        return $this->render(
            'backoffice/products/addcategories.html.twig',
            [
                'form'          =>  $form->createView(),
                "sitetype"      =>  $query,
                "categories"    =>  $query2
            ]
        );
    }
}
