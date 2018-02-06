<?php
namespace App\Controller;

use App\Entity\WebsiteInfo;
use App\Entity\Pages;
use App\Entity\Contact;
use App\Form\ContactOptionType;
use App\Form\PortfolioOptionType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class OptionsController extends Controller
{
	/**
	* @Route("/craft/options", name="options")
	*/
	public function displayOptionsAction(Request $request) {

        $repository = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $query = $repository->findOneBy(
            ["sitetype" =>  "2"]
        );
        
        $rep2 = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep2->findBy(
            [
                "status"    =>  "nonlu"
            ]
        );

        $user = $this->getUser();
        $user->getId();

        $rep = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $pages = $rep->findAll();

        $fetchContactMod = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $contactMod = $fetchContactMod->findOneBy(
            ["optionname" => "contact",
             "description"  =>  "module"
            ]   
        );

        $fetchPortfolioMod = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $portfolioMod = $fetchPortfolioMod->findOneBy(
            ["optionname" => "portfolio",
             "description"  =>  "module"
            ]   
        );

        $modId = $this->getDoctrine()->getManager()->getRepository(WebsiteInfo::class);
        $mod = $modId->findAll();

        $modContact = new WebsiteInfo();
        $activContact = $this->createForm(ContactOptionType::class, $modContact);

        $activContact->handleRequest($request);
        if ($activContact->isSubmitted() && $activContact->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $modContact = $contactMod->setSiteType(3);
            $em->persist($modContact);
            $em->flush();
            return $this->redirectToRoute('options');
        }

        $modPortfolio = new WebsiteInfo();
        $activPortfolio = $this->createForm(PortfolioOptionType::class, $modPortfolio);

        $activPortfolio->handleRequest($request);
        if ($activPortfolio->isSubmitted() && $activPortfolio->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $modPortfolio = $portfolioMod->setSiteType(4);
            $em->persist($modPortfolio);
            $em->flush();
            return $this->redirectToRoute('options');
        }

        return $this->render('backoffice/customs/options.html.twig',
            ["sitetype" =>  $query, "activContact" => $activContact->createView(), "contact" => $contactMod, "messages"  =>  $query2, "mod" => $mod, "portfolio" => $portfolioMod, "activPortfolio" => $activPortfolio->createView()]
        );
	}

    /**
    * @Route("/craft/options/disable/{optionname}", name="disablemodule")
    */
    public function disableModuleAction(Request $request, $optionname)
    {
        $em = $this->getDoctrine()->getManager();
        $mod = $em->getRepository(WebsiteInfo::class)
            ->findOneBy(['optionname' => $optionname])
            ->setSiteType(0);
        $em->flush();

        return $this->redirect($this->generateUrl('options'));
    }
}
