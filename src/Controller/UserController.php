<?php

// Gestion des utilisateurs avec en plus "mes recettes" -> recettes favorite d'un utilisateur

namespace App\Controller;

use App\Form\UserType;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/application/mon-profil", name="app_user_")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [

        ]);
    }

    /**
     * @Route("/mes-recettes", name="recipe")
     */
    public function recipe()
    {
        return $this->render('user/myRecipe.html.twig', [

        ]);
    }

    /**
     * @Route("/modifier-mon-profil", name="edit")
     */
    public function edit(Request $request)
    {
        $user = $this->getUser();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->handleRequest($request);

        if ($userForm->isSubmitted() && $userForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash(
                'info',
                'Mise à jour effectuée'
            );

            return $this->redirectToRoute('app_user_home');
        }

        return $this->render('user/edit.html.twig', [
            'userForm' => $userForm->createView(),
        ]);
    }

    /**
     * @Route("/mettre-à-jour-mon-mot-de-passe", name="upPassword")
     * 
     * @return Response
     */
    public function upPassword(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder ) {
        
        $passwordUp =new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUp);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            if(!password_verify($passwordUp->getOldPassword(), $user->getPassword())) {
                $form->get('oldPassword')->addError(new FormError("Mot de passe incorrect"));
            } else {
                $newPassword = $passwordUp->getNewPassword();
                $password = $encoder->encodePassword($user, $newPassword);
                $user->setPassword($password);
                
                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe à bien été modifié !"
                );

                return $this->redirectToRoute('app_user_home');
            }
        }
        return $this->render('user/password.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
