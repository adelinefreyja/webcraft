<?php
namespace App\Controller;
use App\Entity\User;
use App\Entity\Pages;
use App\Entity\Contact;
use App\Entity\Newsletter;
use App\Entity\UserAddress;
use App\Entity\Customers;
use App\Form\UserType;
use App\Form\ContactType;
use App\Form\NewsletterType;
use App\Form\UserModifyInfoType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class SitePublicController extends Controller
{


	/**
	* @Route("/ColoShop/{category_name}", name="sitepublic")
	*/
    public function publicPage(Request $request, $category_name, UserPasswordEncoderInterface $passwordEncoder, AuthenticationUtils $authUtils){
      
        $repository = $this->getDoctrine()->getManager()->getRepository(Pages::class);
        $query = $repository->findOneBy(
            ['category_name' => $category_name]
        );
        $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $query2 = $rep->findBy(
                [
                    "status"    =>  "nonlu"
                ]
            );
            /* View NEWSLETTER */
                $newsletter = new Newsletter();
                $newsletterForm = $this->createForm(NewsletterType::class, $newsletter);
                $newsletterForm->handleRequest($request);

                if ($newsletterForm->isSubmitted() && $newsletterForm->isValid()) {
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($newsletter);
                    $em->flush();
                    $this->addFlash(
                        'success',
                        "Email enregistrer!"
                    );
                    $query = $repository->findOneBy(
                        ['category_name' => "Accueil"]
                    );
                    return $this->redirectToRoute('sitepublic',["category_name" =>  $query]);
                } 
                /* View Accueil */
        if($category_name == "Accueil"){

            return $this->render('front\ColoShop\index.html.twig',
            ["Pages" =>  $query,  'newsletterform' => $newsletterForm->createView()]
            );
            /* View Contact */
        }elseif ($category_name == "Contact") {

            $contact = new Contact();
            $contactForm = $this->createForm(ContactType::class, $contact);

            $contactForm->handleRequest($request);
                
                if ($contactForm->isSubmitted() && $contactForm->isValid()) {
                    $contact->setMessageDate(new \DateTime('now'));
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($contact);
                    $em->flush();
                    $this->addFlash(
                        'success',
                        "Message envoyé !"
                    );
                    $query = $repository->findOneBy(
                        ['category_name' => "Accueil"]
                    );
                    return $this->redirectToRoute('sitepublic',["category_name" =>  $query]);
                }
        
               
                return $this->render('front\ColoShop\contact.html.twig',
                    ["Pages" =>  $query, 'contactform' => $contactForm->createView(), "messages"  =>  $query2 , 'newsletterform' => $newsletterForm->createView(),]
                );

        }
        /* View Shop */
        elseif($category_name == "Shop"){
            return $this->render('front\ColoShop\categories.html.twig',
            ["Pages" =>  $query,  'newsletterform' => $newsletterForm->createView(),]
            );
        }
        /* View Pages */
        elseif($category_name == "Pages"){
            return $this->render('front\ColoShop\single.html.twig',
            ["Pages" =>  $query ,  'newsletterform' => $newsletterForm->createView(),]
            );
        }
        /*Register*/
        elseif($category_name == "Register"){
            $rep = $this->getDoctrine()->getManager()->getRepository(Contact::class);
            $query2 = $rep->findBy(
            [
                "status"    =>  "nonlu"
            ]
            );
            $user = new User();
            $form = $this->createForm(UserType::class, $user);

            // 2) handle the submit (will only happen on POST)
            $form->handleRequest($request);
               

            if ($form->isSubmitted() && $form->isValid()) {

               

                // 3) Encode the password (you could also do this via Doctrine listener)
                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                // 4) save the User!
                $user->setRoles(['ROLE_CUSTOMER']);
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();

                $userid = $user->getId();

                $userAddress = new UserAddress();
                $userAddress->setId($userid);
                $em = $this->getDoctrine()->getManager();
                $em->persist($userAddress);
                $em->flush();

                $useradd = $userAddress->getUserAddressId();

                $userCustom = new Customers();
                $userCustom->setUserAddressId($useradd);
                $userCustom->setId($userid);
                $em = $this->getDoctrine()->getManager();
                $em->persist($userCustom);
                $em->flush();

                // ... do any other work - like sending them an email, etc
                // maybe set a "flash" success message for the user

              return $this->redirectToRoute('sitepublic' ,["category_name" =>  "Signin"]);
            }

        return $this->render('front\ColoShop\register.html.twig',
            array(
                "sitetype"  =>  $query, 
                "form" => $form->createView(),
                "Pages" =>  $query ,  
                'newsletterform' => $newsletterForm->createView(), 
                "messages"  =>  $query2
            )
        );
    }
       /* CONNEXION */

       elseif ($category_name == "Signin") {
    
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        return $this->render('front\ColoShop\login.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
             'newsletterform' => $newsletterForm->createView(), 
        ));
    }
    /* DECONNEXION */
     elseif ($category_name == "Deconnexion") {
       if(isset($_SESSION)){
        session_destroy();
       }
        return $this->redirectToRoute('sitepublic',
                ["category_name" => 'Accueil']);
    }
    /* PROFIL */
     elseif ($category_name == "Profil") {
    
        // get the login error if there is one
        $error = $authUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authUtils->getLastUsername();

        $em = $this->getDoctrine()->getManager();
        $rawSql = "SELECT * FROM user, user_address, customers WHERE user.id = user_address.id AND customers.id = user.id";

        $statement = $em->getConnection()->prepare($rawSql);
        $statement->execute();

        $result = $statement->fetchAll();
        return $this->render('front\ColoShop\profil.html.twig', array(
            'last_username' => $lastUsername,
            'error'         => $error,
            "profil" => $result,
            'newsletterform' => $newsletterForm->createView(),
            
        ));
    }

     /* Si l'URL est incorrect */
        else {
            $query = $repository->findOneBy(
                ['category_name' => "Accueil"]
            );
            return $this->redirectToRoute('sitepublic',
                ["category_name" =>  $query]
            );
        }
      }


    /**
     * ça, c'est une méthode de Symfony, elle permet la connexion, on touche pas
     * @Route("/login_check", name="login_check")
     */
    public function check()
    {
        throw new \RuntimeException('You must configure the check path to be handled by the firewall using form_login in your security firewall configuration.');
    }

    /**
     * la méthode pour se déconnecter, gérer pas Symfony, donc on laisse la méthode de base
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
        throw new \RuntimeException('You must activate the logout in your security firewall configuration.');
    }

}