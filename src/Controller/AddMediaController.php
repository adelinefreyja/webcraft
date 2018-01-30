<?php
namespace App\Controller;

use App\Entity\Medias;
use App\Entity\WebsiteInfo;
use App\Form\MediasType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AddMediaController extends Controller
{
	/**
	* @Route("/craft/medias/newmedia", name="addmedia")
	*/
	public function new(Request $request) {

        $media = new Medias();
        $form = $this->createForm(MediasType::class, $media);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form["mediaSrc"]->getData();

            try {
                $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            } catch (\Exception $e) {
                $fileName = md5(uniqid()) . '.' . $file->getExtension();
            }

            $file->move(
                $this->getParameter('medias_directory'),
                $fileName
            );

            $media->setMediaSrc("img/medias/" . $fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($media);
            $em->flush();

        }

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        return $this->render('backoffice/medias/addmedia.html.twig',
            ["sitetype" =>  $query,
                'form' => $form->createView()]
        );
	}
}
