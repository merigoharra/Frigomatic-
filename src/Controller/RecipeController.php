<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use Cocur\Slugify\Slugify;
use App\Repository\TagRepository;
use App\Repository\UserRepository;
use App\Repository\RecipeRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Tag;

/**
 * @Route("/application/recettes", name="app_recipe_")
 */
class RecipeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(RecipeRepository $recipeRepo, TagRepository $tagRepo)
    {
        $recipes = $recipeRepo->findAll();

        $tags = $tagRepo->findAll();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'tags' => $tags

        ]);
    }

    /**
     * @Route("/new", name="new")
     */
    public function create(Request $request)
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $slugger = new Slugify();

            $slug = $slugger->slugify($recipe->getName());

            $recipe->setSlug($slug);

            $recipe->SetTotalDuration($recipe->getPrepDuration() + $recipe->getBakingDuration());

            $recipe->setUser($this->getUser());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($recipe);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre recette est bien ajoutée'
            );

            return $this->redirectToRoute('app_recipe_ingredient_add', ['id' => $recipe->getId()]);
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
     * @Route("/tag/{id}", name="tag")
     */
    public function tag(TagRepository $repo, $id)
    { 
        $tag = $repo->findOneById($id);

        return $this->render('recipe/tag.html.twig', [
            'tags' => $tag
            ]);
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

        $recipeProducts = $recipe->getRecipeProducts();

        // dd($recipeProducts);

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'isFav' => $isFav,
            'recipeProducts' => $recipeProducts
                    ]);
    }
}
