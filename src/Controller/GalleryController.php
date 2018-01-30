<?php
namespace App\Controller;

use App\Entity\Medias;
use App\Entity\WebsiteInfo;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    /**
     * @Route("/craft/gallery", name="gallery")
     */
    public function new(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $queryPictures = $this->getDoctrine()->getManager()->getRepository(Medias::class);
        $pictures = $queryPictures->findAll();

        return $this->render('backoffice/medias/medialibrary.html.twig',
            [
                "pictures"  =>  $pictures,
                "sitetype"  =>  $query
            ]
        );
    }
}
