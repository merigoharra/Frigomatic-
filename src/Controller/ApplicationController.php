<?php

// Controller de l'accueil de l'application (une fois l'utilisateur connecté)

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\RecipeProductRepository;
use App\Repository\RecipeRepository;

/**
 * @Route("/application", name="app_")
 */
class ApplicationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecipeProductRepository $recipeProductRepository, RecipeRepository $recipeRepo)
    {
        $user = $this->getUser()->getId();
        $myRecipesId = $recipeProductRepository->findMyPersonalRecipe($user);

        $recipes = $recipeRepo->findById($myRecipesId);


        return $this->render('application/index.html.twig', [
            'recipes' => $recipes
        ]);
    }
}
