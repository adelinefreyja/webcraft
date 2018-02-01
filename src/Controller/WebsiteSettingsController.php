<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Form\WebsiteModifyInfoType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class WebsiteSettingsController extends Controller
{
	/**
	* @Route("/craft/settings/website", name="websitesettings")
	*/
	public function websiteSettingsAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $logo = $repository->findOneBy(
            ["optionname" =>  "logo"]
        );

            $website = $repository->findOneBy(['description' => 'siteinfo']);
            $form = $this->createForm(WebsiteModifyInfoType::class, $website);

            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('websitesettings');
        }

        return $this->render('backoffice/settings/websitesettings.html.twig',
            array(
                "sitetype"  =>  $query,
                "form"      => $form->createView(),
                'website'   => $website,
                'logo'      =>  $logo
            )
        );


        // return new Response($website->getOptionname(), $website->getOptionValue);
	}
}
