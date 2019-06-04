<?php

// Gestion des visiteurs donc méthode non bloqué par sécurity.yaml 

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        if ($this->getUser() !== null) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('home/index.html.twig');
    }
    
    /**
     * @Route("/inscription", name="new_user")
     */
    public function create(Request $request, UserPasswordEncoderInterface $passwordEncoder)
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