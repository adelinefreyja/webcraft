<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Form\WebsiteModifyInfoType;
use App\Form\LogoModifyType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

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
                'logo'      =>  $logo,
                'option'    =>  null
            )
        );


        // return new Response($website->getOptionname(), $website->getOptionValue);
	}

    /**
     * @Route("/craft/settings/website/{option}", name="nextwebsitesettings")
     */
    public function nextWebsiteSettingsAction(Request $request, $option) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );

        $logo = $repository->findOneBy(
            ["optionname" =>  "logo"]
        );

        if ($option == 'logo') {
            $website = $logo;
            $form = $this->createForm(LogoModifyType::class, $website);
        } else {
            $website = $repository->findOneBy(['description' => 'siteinfo']);
            $form = $this->createForm(WebsiteModifyInfoType::class, $website);
        }

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if ($option == 'logo') {

                $file = $form["optionvalue"]->getData();

                try {
                    $fileName = 'logo.' . $file->guessExtension();
                } catch (\Exception $e) {
                    $fileName = 'logo.' . $file->getExtension();
                }

                $file->move(
                    $this->getParameter('source_directory'),
                    $fileName
                );


                $website->setOptionvalue("img/" . $fileName);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($website);
            $em->flush();

            return $this->redirectToRoute('websitesettings');
        }

        return $this->render('backoffice/settings/websitesettings.html.twig',
            array(
                "sitetype"  =>  $query,
                "form"      => $form->createView(),
                'website'   => $website,
                'logo'      =>  $logo,
                'option'    =>  $option
            )
        );
    }
}
