<?php

// Gestion des visiteurs donc méthode non bloqué par sécurity.yaml 

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Repository\RoleRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, UserPasswordEncoderInterface $passwordEncoder, AuthenticationUtils $authenticationUtils, RoleRepository $roleRepo)
    {
        // Si l'utilisateur est connecté -> redirection vers app_home
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_home');
        }
            // ********* Gestion de la connexion *************

            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();


            // ******** Gestion de l'inscription *************

            // Création du formulaire
            $newUser = new User();
            $form = $this-> createForm(UserType::class, $newUser);
            $form->handleRequest($request);
    
            // gestion de la soumission du form d'inscription
            if ($form->isSubmitted() && $form->isValid()) {
                
                // Hashage du password avant l'insertion en BDD
                $hash = $passwordEncoder->encodePassword($newUser, $newUser->getPassword());
                $newUser->setPassword($hash);
    
                // Set du role de l'utilisateur sur user par default
                $newUser->setRole($roleRepo->findOneBy(['role' => 'user']));
                
                // Enregistrement en BDD
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newUser);
                $entityManager->flush();
    
                // Ajout du message flash
                $this->addFlash(
                    'success',
                    'Votre compte à bien été créer'
                );
                
                // Redirection vers la page de connexion une fois l'inscription terminé
                return $this->redirectToRoute('app_login');
            }

        return $this->render('home/index.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'form' => $form->createView()
        ]);
    }
    

    // *****************************************************************************************
    // ************************* Route Inutilisée pour le le moment ****************************
    // *****************************************************************************************


    /**
     * @Route("/inscription", name="new_user")
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder, RoleRepository $roleRepo)
    {
        // Vérification de le connexion d'un utilisateur
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_home');
        }

        // création du formulaire
        $newUser = new User();
        $form = $this-> createForm(UserType::class, $newUser);
        $form->handleRequest($request);

        // Gestion de la soumission du formulaire
        if ($form->isSubmitted() && $form->isValid()) {

            // Hashage du password
            $hash = $passwordEncoder->encodePassword($newUser, $newUser->getPassword());
            $newUser->setPassword($hash);

            // Set du role de l'utilisateur sur User
            $newUser->setRole($roleRepo->findOneBy(['role' => 'user']));
            
            // Enregistrement en BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();

            // Ajout du message Flash
            $this->addFlash(
                'success',
                'Votre compte à bien été créer'
            );

            // Redirection vers la page de login une fois l'inscrition terminé
            return $this->redirectToRoute('app_login');
        }


        return $this->render('home/register.html.twig', [
            'form' => $form->createView()
                    ]);
    }

}