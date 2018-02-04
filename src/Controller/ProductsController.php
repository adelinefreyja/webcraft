<?php

namespace App\Controller;

use App\Entity\ProductsImages;
use App\Entity\Products;
use App\Entity\ProductsStock;
use App\Entity\WebsiteInfo;
use App\Entity\ProductsTax;
use App\Entity\ProductsCategory;
use App\Entity\Contact;
use App\Form\ProductsImagesType;
use App\Form\ProductsStockType;
use App\Form\ProductsCategoriesType;
use App\Form\ProductsAddTaxType;
use App\Form\ProductsEditCategoryType;
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

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

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

            $idProduit = $produit->getProduct()->getProductId();

            return $this->redirectToRoute('addproducts2', ["idProduit"  =>  $idProduit]);
        }

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        return $this->render(
            'backoffice/products/addproducts.html.twig',
            [
                'form' => $form->createView(),
                "sitetype" =>  $query,
                "messages"  =>  $query2
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

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query3 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $category->setProduct((int)$idProduit);
            $em->persist($category);
            $em->flush();

            return $this->redirectToRoute('manageproducts');
        }

        return $this->render(
            'backoffice/products/addcategories.html.twig',
            [
                'form'          =>  $form->createView(),
                "sitetype"      =>  $query,
                "categories"    =>  $query2,
                "messages"      =>  $query3
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts/edit/{idProduit}", name="editproduct")
     */
    public function editProduct(Request $request, $idProduit) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $_SESSION["produitencours"] = "";
        $_SESSION["produitencours"] = $idProduit;

        if (isset($_POST["products_stock"]) && !empty($_POST["products_stock"])) {

            $size = new ProductsStock();

            $sizeValue = strip_tags(trim((string)$_POST["products_stock"]["sizeValue"]));
            $colorValue = strip_tags(trim((string)$_POST["products_stock"]["colorValue"]));
            $stockValue = strip_tags(trim((string)$_POST["products_stock"]["stockValue"]));
            $checkId = strip_tags(trim((int)$_SESSION["produitencours"]));

            $em = $this->getDoctrine()->getManager();
            $size->setProduct($checkId);
            $size->setSizeValue($sizeValue);
            $size->setColorValue($colorValue);
            $size->setStockValue($stockValue);
            $em->persist($size);
            $em->flush();

            return $this->redirectToRoute('editproduct', ["idProduit"   =>  $_SESSION["produitencours"]]);

        } else if (isset($_POST["products_add_tax"]) && !empty($_POST["products_add_tax"])) {

            $repository = $this->getDoctrine()->getManager()->getRepository(Products::class);
            $tax = $repository->findOneBy(
                ["productId" =>  (int)$_SESSION["produitencours"]]
            );

            $taxId = strip_tags(trim((int)$_POST["products_add_tax"]["tax"]));

            $em = $this->getDoctrine()->getManager();
            $tax->setTax($taxId);
            $em->flush();

            return $this->redirectToRoute('editproduct', ["idProduit"   =>  $_SESSION["produitencours"]]);

        } else if (isset($_POST["products_edit_category"]) && !empty($_POST["products_edit_category"])) {

            $repository = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
            $category = $repository->findOneBy(
                ["product" =>  (int)$_SESSION["produitencours"]]
            );

            $categoryValue = strip_tags(trim((string)$_POST["products_edit_category"]["categoryValue"]));

            $em = $this->getDoctrine()->getManager();
            $category->setCategoryValue($categoryValue);
            $em->flush();

            return $this->redirectToRoute('editproduct', ["idProduit"   =>  $_SESSION["produitencours"]]);
        }

        return $this->render(
            'backoffice/products/editproducts.html.twig',
            [
                "sitetype"      =>  $query,
                "messages"      =>  $query2
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts/editstocks", name="editstocks")
     */
    public function editStocks(Request $request) {

        $stock = new ProductsStock();
        $form = $this->createForm(ProductsStockType::class, $stock);
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsStock::class);
        $query2 = $repository2->findAll();

        return $this->render('backoffice/products/editstocks.html.twig',
            [
                'form'     =>  $form->createView(),
                'stock'    =>   $query2,
                'produit'  =>   $_SESSION["produitencours"]
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts/edittaxes", name="edittaxes")
     */
    public function editTaxes(Request $request) {

        $prod = new Products();
        $form = $this->createForm(ProductsAddTaxType::class, $prod);
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsTax::class);
        $query2 = $repository2->findAll();

        return $this->render('backoffice/products/edittaxe.html.twig',
            [
                'form'    =>  $form->createView(),
                'taxes'   =>  $query2
            ]
        );
    }

    /**
    * @Route("/craft/products/manageproducts/editcategory", name="editcategory")
    */
    public function editCategorie(Request $request) {

        $category = new ProductsCategory();
        $form = $this->createForm(ProductsEditCategoryType::class, $category);
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
        $query2 = $repository2->findAll();

        return $this->render('backoffice/products/editcategory.html.twig',
            [
                'form'    =>  $form->createView(),
                'categories'   =>  $query2
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts/editproductspictures", name="editproductspictures")
     */
    public function editPictures(Request $request) {

        $pictures = new ProductsImages();
        $form = $this->createForm(ProductsImagesType::class, $pictures);
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsImages::class);
        $query2 = $repository2->findOneBy(
            [
                "productId" =>  $_SESSION["produitencours"]
            ]
        );

        return $this->render('backoffice/products/editproductspictures.html.twig',
            [
                'form'      =>  $form->createView(),
                'pictures'  =>  $query2
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts", name="manageproducts")
     */
    public function manageProducts(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $repository2 = $this->getDoctrine()->getManager()->getRepository(Products::class);
        $query2 = $repository2->findAll();

        $repository3 = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
        $query3 = $repository3->findAll();

        $repository4 = $this->getDoctrine()->getManager()->getRepository(ProductsImages::class);
        $query4 = $repository4->findAll();

        $repository5 = $this->getDoctrine()->getManager()->getRepository(ProductsStock::class);
        $query5 = $repository5->findAll();

        $repository7 = $this->getDoctrine()->getManager()->getRepository(ProductsTax::class);
        $query7 = $repository7->findAll();

        $repository8 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query8 = $repository8->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        return $this->render(
            'backoffice/products/manageproducts.html.twig',
            [
                "sitetype"      =>  $query,
                "products"      =>  $query2,
                "categories"    =>  $query3,
                "pictures"      =>  $query4,
                "stock"         =>  $query5,
                "taxes"         =>  $query7,
                "messages"      =>  $query8
            ]
        );
    }
}
