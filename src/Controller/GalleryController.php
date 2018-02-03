<?php
namespace App\Controller;

use App\Entity\Medias;
use App\Entity\WebsiteInfo;
use App\Form\Contact;
use App\Form\ModifyMediasType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GalleryController extends Controller
{
    /**
     * @Route("/craft/medias/gallery", name="gallery")
     */
    public function showMEdias(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
        
        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findAll();

        $queryPictures = $this->getDoctrine()->getManager()->getRepository(Medias::class);
        $pictures = $queryPictures->findAll();

        return $this->render('backoffice/medias/medialibrary.html.twig',
            [
                "pictures"  =>  $pictures,
                "sitetype"  =>  $query,
                "messages"  =>  $query2
            ]
        );
    }

    /**
     * @Route("/craft/medias/gallery/edit/{id}", name="editmedias")
     */
    public function editMedias(Request $request, $id)
    {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $media = $this->getDoctrine()
            ->getManager()
            ->getRepository(Medias::class)
            ->find($id)
        ;

        $form = $this->createForm(ModifyMediasType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash(
                'success',
                "Media mis à jour !"
            );
            return $this->redirect($this->generateUrl('gallery'));
        }

        return $this->render('backoffice/medias/editmedias.html.twig',
            [
                "sitetype" =>  $query,
                'form' => $form->createView(),
                "media" => $media
            ]
        );
    }
    /**
     * @Route("/craft/medias/gallery/remove/{id}", name="deletemedias")
     */
    public function deleteUserAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $media = $em->getRepository(Medias::class)
            ->find($id);
        $em->remove($media);
        $em->flush();
        $this->addFlash(
            'success',
            'Le media a bien été supprimé'
        );
        return $this->redirect($this->generateUrl('gallery'));
    }
}
