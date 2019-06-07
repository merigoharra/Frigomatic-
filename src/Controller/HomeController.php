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
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_home');
        }
            // get the login error if there is one
            $error = $authenticationUtils->getLastAuthenticationError();
            // last username entered by the user
            $lastUsername = $authenticationUtils->getLastUsername();


            $newUser = new User();
            $form = $this-> createForm(UserType::class, $newUser);
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid()) {
    
                $hash = $passwordEncoder->encodePassword($newUser, $newUser->getPassword());
                $newUser->setPassword($hash);
    
                $newUser->setRole($roleRepo->findOneBy(['role' => 'user']));
                
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($newUser);
                $entityManager->flush();
    
                $this->addFlash(
                    'success',
                    'Votre compte à bien été créer'
                );
    
                return $this->redirectToRoute('app_login');
            }

        return $this->render('home/index.html.twig', [
            'last_username' => $lastUsername, 
            'error' => $error,
            'form' => $form->createView()
        ]);
    }
    
    /**
     * @Route("/inscription", name="new_user")
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder, RoleRepository $roleRepo)
    {
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_home');
        }

        $newUser = new User();
        $form = $this-> createForm(UserType::class, $newUser);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $hash = $passwordEncoder->encodePassword($newUser, $newUser->getPassword());
            $newUser->setPassword($hash);

            $newUser->setRole($roleRepo->findOneBy(['role' => 'user']));
            
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUser);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre compte à bien été créer'
            );

            return $this->redirectToRoute('app_login');
        }


        return $this->render('home/register.html.twig', [
            'form' => $form->createView()
                    ]);
    }

}