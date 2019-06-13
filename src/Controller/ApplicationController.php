<?php

// Controller de l'accueil de l'application (une fois l'utilisateur connecté)

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecipeProductRepository;
use App\Repository\RecipeRepository;
use App\Repository\TagRepository;
use App\Repository\UserProductRepository;

/**
 * @Route("/application", name="app_")
 */
class ApplicationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecipeProductRepository $recipeProductRepository, RecipeRepository $recipeRepo, TagRepository $tagRepo, UserProductRepository $userProductRepo)
    {
        /* on récupere la requete custom de RecipeProductRepository.php que l'on mets dans une variable $myRecipesId, la valeur de cette variable est un tableau d'id de recettes qui match avec les ingrédients de l'user récuperer dans $user*/ 
        /* ensuite, dans un for each pour chaque résultats que l'on récupere dans la requete, on revoi la ligne récuprer à l'id de recette , chaque ligne est enregistrer dans un  tableau $recipes, ex: [ 1=> [ id=>5, name=> tarte au pomme],...] */
        $user = $this->getUser()->getId();
        $myRecipesId = $recipeProductRepository->findMyPersonalRecipe($user);;
        $recipes = [];
        foreach ($myRecipesId as $id) {
            $recipe = $recipeRepo->findOneBy(['id' => $id]);
            $recipes[] = $recipe;
        }
        /*---------------------------------------------*/
        // Recupération des tags pour trier les recettes
        $tags = $tagRepo->findAll();

        /*---------------------------------------------*/
        // Affichage des produits les plus anciens 
        $oldestProducts = $userProductRepo->findByOldestUpdate();
        return $this->render('application/index.html.twig', [
            'recipes' => $recipes,
            'tags' => $tags,
            'oldestProducts' => $oldestProducts
        ]);
    }

    
}
