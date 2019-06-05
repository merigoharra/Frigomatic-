<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Cocur\Slugify\Slugify;
use App\Repository\UserRepository;
use App\Repository\RecipeRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/application/recettes", name="app_recipe_")
 */
class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecipeRepository $repo)
    {
        $recipe = $repo->findAll();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipe

        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function create(Request $request, UserRepository $userRepositiry)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $slugger = new Slugify();

            $slug = $slugger->slugify($recipe->getName());

            $recipe->setSlug($slug);

            $recipe->SetTotalDuration($recipe->getPrepDuration() + $recipe->getBakingDuration());

            $recipe->setUser($userRepositiry->findOneById(10));

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre recette est bien ajoutée'
            );

            return $this->redirectToRoute('app_recipe_home');
        }


        return $this->render('recipe/new.html.twig', [
            'form' => $form->createView()
                    ]);
    }

    /**
     * @Route("/{id}/ajouter-aux-favoris", name="add_fav")
     */
    public function addFav(Recipe $recipe)
    {
        $user = $this->getUser();
        $user->addFavoriteRecipe($recipe);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Votre recette est bien ajoutée à vos favoris'
        );

        return $this->redirectToRoute('app_recipe_show', ['slug' => $recipe->getSlug()]);
    }

    /**
     * @Route("/{id}/supprimer-des-favoris", name="delete_fav")
     */
    public function deleteFav(Recipe $recipe)
    {
        $user = $this->getUser();
        $user->removeFavoriteRecipe($recipe);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash(
            'success',
            'Votre recette est bien ajoutée à vos favoris'
        );

        return $this->redirectToRoute('app_user_recipe');
    }


    /**
     * @Route("/{slug}", name="show")
     */
    public function show(Recipe $recipe)
    {
        // Pas très opti car on génére une requête qui appel toutes les recettes favorites de l'utilisateur avant de les trier, l'idéale serait de le faire directement dans la requête. Mais pas dérangeant sur cette méthode en supposant que l'utilisateur n'aura pas 1000 recettes favorites
        $isFav = false;
        if ($this->getUser()->getFavoriteRecipes()->contains($recipe)) {
            $isFav = true;
        }
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'isFav' => $isFav
                    ]);
    }
}
