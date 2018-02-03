<?php

namespace App\Controller;

use App\Entity\ProductsImages;
use App\Entity\Products;
use App\Entity\WebsiteInfo;
use App\Entity\ProductsSizes;
use App\Entity\ProductsColors;
use App\Entity\ProductsTax;
use App\Entity\ProductsCategory;
use App\Form\ProductsImagesType;
use App\Form\ProductsColorsType;
use App\Form\ProductsCategoriesType;
use App\Form\ProductsSizesType;
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
                "categories"    =>  $query2
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

        $_SESSION["produitencours"] = $idProduit;

        if (isset($_POST["products_sizes"]) && !empty($_POST["products_sizes"])) {

            $size = new ProductsSizes();

            $sizeValue = strip_tags(trim((string)$_POST["products_sizes"]["sizeValue"]));
            $sizeStock = strip_tags(trim((string)$_POST["products_sizes"]["sizeStock"]));
            $checkId = strip_tags(trim((int)$idProduit));

            $em = $this->getDoctrine()->getManager();
            $size->setProduct($checkId);
            $size->setSizeValue($sizeValue);
            $size->setSizeStock($sizeStock);
            $em->persist($size);
            $em->flush();

            return $this->redirectToRoute('editproduct', ["idProduit"   =>  $idProduit]);

        } else if (isset($_POST["products_colors"]) && !empty($_POST["products_colors"])) {

            $color = new ProductsColors();

            $colorValue = strip_tags(trim((string)$_POST["products_colors"]["colorValue"]));
            $colorStock = strip_tags(trim((string)$_POST["products_colors"]["colorStock"]));
            $checkId = strip_tags(trim((int)$idProduit));

            $em = $this->getDoctrine()->getManager();
            $color->setProduct($checkId);
            $color->setColorValue($colorValue);
            $color->setColorStock($colorStock);
            $em->persist($color);
            $em->flush();

            return $this->redirectToRoute('editproduct', ["idProduit"   =>  $idProduit]);

        } else if (isset($_POST["products_add_tax"]) && !empty($_POST["products_add_tax"])) {

            $repository = $this->getDoctrine()->getManager()->getRepository(Products::class);
            $tax = $repository->findOneBy(
                ["productId" =>  $idProduit]
            );

            $taxId = strip_tags(trim((int)$_POST["products_add_tax"]["tax"]));

            $em = $this->getDoctrine()->getManager();
            $tax->setTax($taxId);
            $em->flush();

            return $this->redirectToRoute('editproduct', ["idProduit"   =>  $idProduit]);

        } else if (isset($_POST["products_edit_category"]) && !empty($_POST["products_edit_category"])) {

            $repository = $this->getDoctrine()->getManager()->getRepository(ProductsCategory::class);
            $category = $repository->findOneBy(
                ["product" =>  $idProduit]
            );

            $categoryValue = strip_tags(trim((string)$_POST["products_edit_category"]["categoryValue"]));

            $em = $this->getDoctrine()->getManager();
            $category->setCategoryValue($categoryValue);
            $em->flush();
        }

        return $this->render(
            'backoffice/products/editproducts.html.twig',
            [
                "sitetype"      =>  $query
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts/editsizes", name="editsizes")
     */
    public function editSizes(Request $request) {

        $size = new ProductsSizes();
        $form = $this->createForm(ProductsSizesType::class, $size);
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsSizes::class);
        $query2 = $repository2->findAll();

        return $this->render('backoffice/products/editsizes.html.twig',
            [
                'form'     =>  $form->createView(),
                'sizes'    =>  $query2
            ]
        );
    }

    /**
     * @Route("/craft/products/manageproducts/editcolors", name="editcolors")
     */
    public function editColors(Request $request) {

        $color = new ProductsColors();
        $form = $this->createForm(ProductsColorsType::class, $color);
        $form->handleRequest($request);

        $repository2 = $this->getDoctrine()->getManager()->getRepository(ProductsColors::class);
        $query2 = $repository2->findAll();

        return $this->render('backoffice/products/editcolors.html.twig',
            [
                'form'     =>  $form->createView(),
                'colors'   =>  $query2
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

        $repository5 = $this->getDoctrine()->getManager()->getRepository(ProductsSizes::class);
        $query5 = $repository5->findAll();

        $repository6 = $this->getDoctrine()->getManager()->getRepository(ProductsColors::class);
        $query6 = $repository6->findAll();

        $repository7 = $this->getDoctrine()->getManager()->getRepository(ProductsTax::class);
        $query7 = $repository7->findAll();

        return $this->render(
            'backoffice/products/manageproducts.html.twig',
            [
                "sitetype"      =>  $query,
                "products"      =>  $query2,
                "categories"    =>  $query3,
                "pictures"      =>  $query4,
                "sizes"         =>  $query5,
                "colors"        =>  $query6,
                "taxes"         =>  $query7
            ]
        );
    }
}
