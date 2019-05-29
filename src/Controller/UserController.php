<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
