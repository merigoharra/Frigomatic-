<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\RecipeProduct;
use App\Form\RecipeProductType;
use App\Repository\RecipeProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/application/recette-ingrédients", name="app_recipe_ingredient_")
 */
class RecipeProductController extends AbstractController
{
    /**
     * @Route("/ajouter/{id}", name="add")
     */
    public function add(RecipeProductRepository $recipeProductRepo, Request $request, Recipe $recipe)
    {

        // Methode index permet d'afficher la page d'accueil mais aussi le form d'ajout d'un produit en fonction d'une quantité dans le frigo (nouvelle ligne dans la table userProduct)

        // Création de l'objet et association avec un formulaire
        $newRecipeProduct = new RecipeProduct();
        $form = $this-> createForm(RecipeProductType::class, $newRecipeProduct);
        $form->handleRequest($request);

        $recipeProducts = $recipe->getRecipeProducts();

        if ($form->isSubmitted() && $form->isValid()) {

            // Set de la recette
            $newRecipeProduct->setRecipe($recipe);

            // Récupération du produit en court d'ajout
            $currentProduct = $newRecipeProduct->getProduct(); 

            $quantityToAdd = $newRecipeProduct->getQuantity();

            // Vérification de l'existance d'une ligne identique dans la BDD pour faire une incrémentation plutot qu'un ajout
            if ($recipeProductRepo->findOneBy([
                'recipe' => $recipe,
                'product' => $currentProduct
            ])) {
                $newRecipeProduct = $recipeProductRepo->findOneBy([
                    'recipe' => $recipe,
                    'product' => $currentProduct
                ]);
                $quantity = $newRecipeProduct->getQuantity();
                $quantity = $quantity + $quantityToAdd;
                $newRecipeProduct->setQuantity($quantity);
            } 
            // Enregistrement de l'objet en BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newRecipeProduct);
            $entityManager->flush();

            // message flash de confirmation
            $this->addFlash(
                'success',
                'Votre ingrédient est bien ajouté'
            );

            return $this->redirectToRoute('app_recipe_ingredient_add', ['id' => $recipe->getId()]);
        }

        return $this->render('recipe_product/index.html.twig', [
            'recipe' => $recipe,
            'form' => $form->createView(),
            'recipeProducts' => $recipeProducts
        ]);
    }
}
