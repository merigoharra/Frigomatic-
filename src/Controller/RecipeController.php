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
 * @Route("/application/recettes-frigomatc", name="app_recipe_")
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
     * @Route("/{id}/ajouter-aux-favorits", name="add_fav")
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
            'Votre recette est bien ajoutée à vos favorits'
        );

        return $this->redirectToRoute('app_recipe_show', ['slug' => $recipe->getSlug()]);
    }

    /**
     * @Route("/{id}/supprimer-des-favorits", name="delete_fav")
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
            'Votre recette est bien ajoutée à vos favorits'
        );

        return $this->redirectToRoute('app_user_recipe');
    }


    /**
     * @Route("/{slug}", name="show")
     */
    public function show(Recipe $recipe, RecipeRepository $recipeRepo, UserRepository $userRepo)
    {
        // NON FONCTIONNEL -> j'essaye de passer à la vue le fait que la recette est déjà (ou pas) en favori
        $isFav = false;
        // if ($userRepo->findOneBy([
        //     'id' => $this->getUser()->getId(),
        //     'favoriteRecipes' => $recipe
        // ])) {
        //     $isFav = true;
        // }
        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'isFav' => $isFav
                    ]);
    }
}
