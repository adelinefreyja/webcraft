<?php

namespace App\Controller;

use App\Entity\Products;
use App\Entity\ProductsImages;
use App\Entity\WebsiteInfo;
use App\Form\ProductsImagesType;
use App\Form\ProductsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ProductsController extends Controller {

    /**
     * @Route("/craft/addproducts", name="addproducts")
     */
    public function new(Request $request) {

        $produit = new Products();
        $images_produit = new ProductsImages();

        $form1 = $this->createForm(ProductsType::class, $produit);
        $form2 = $this->createForm(ProductsImagesType::class, $images_produit);

        $form1->handleRequest($request);
        $form2->handleRequest($request);

        if ($form1->isSubmitted() && $form1->isValid() && $form2->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            $file = $images_produit->getImage();
            var_dump($_FILES);

            $extension = strrchr($file, '.');
            $extension = strtolower(substr($extension, 1));
            $tabExtensionValide = ["gif", "jpg", "jpeg", "png", "svg"];
            $verifExtension = in_array($extension, $tabExtensionValide);

            if ($verifExtension) {

                $fichier = $form2["image"]->getData();
                $fichier->move("/aaaaaaaaaaaa", $fichier);
            }

//            return $this->redirectToRoute('dashboard');
        }

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        return $this->render(
            'backoffice/products/addproducts.twig',
            ['form1' => $form1->createView(),
                'form2' => $form2->createView(),
                "sitetype" =>  $query]
        );
    }
}
