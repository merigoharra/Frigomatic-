<?php

namespace App\Controller;

use App\Entity\Tag;
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
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use App\Repository\UserProductRepository;

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

            $image = $recipe->getImage();
            $imageName = 'image-of-recipe-'.$recipe->getSlug().'.'.$image->guessExtension();
            $image->move($this->getParameter('upload_directory'), $imageName);

            $recipe->setImage($imageName);

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

        return $this->redirectToRoute('app_recipe_show', ['slug' => $recipe->getSlug()]);
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
     * @Route("/retirer-les-produits-de-cette-recette/{id}", name="removeProducts")
     */
    public function RemoveRecipeProducts(Recipe $recipe, UserProductRepository $userProductRepo)
    {
        // On récupére les produits associé à la recette
        $allRecipeProducts = $recipe->getRecipeProducts();
        // On boucle sur les produits de la recette
        foreach ($allRecipeProducts as $recipeProduct) {
            // Pour chaque produit de recette il faut trouver l'équivalent dans le frigo de l'utilisateur
            $product = $recipeProduct->getProduct();
            $quantity = $recipeProduct->getQuantity();

            $userProduct = $userProductRepo->findOneBy([
                'user' => $this->getUser(),
                'product' => $product
            ]);

            if ($userProduct) {
                $oldQuantity = $userProduct->getQuantity();
                $newQuantity = $oldQuantity - $quantity;

                $entityManager = $this->getDoctrine()->getManager();
                if ($newQuantity <= 0 ) {
                    $entityManager->remove($userProduct);
                } 
                else {
                    $userProduct->setQuantity($newQuantity);
                    $entityManager->persist($userProduct);
                } 
                $entityManager->flush();
            }
        }

        return $this->redirectToRoute('app_home');
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

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
            'isFav' => $isFav,
            'recipeProducts' => $recipeProducts
                    ]);
    }
}
