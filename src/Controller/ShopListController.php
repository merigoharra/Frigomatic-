<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Entity\Product;
use App\Entity\ShopList;
use App\Entity\UserProduct;
use App\Repository\ShopListRepository;
use App\Repository\UserProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/application/ma-liste-de-course", name="app_shopList_")
 */
class ShopListController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ShopListRepository $shopListRepo)
    {
        $shopList = $shopListRepo->findBy([
            'user' => $this->getUser()
        ]);

        return $this->render('shop_list/index.html.twig', [
            'shopList' => $shopList
        ]);
    }

    /**
     * @Route("/ajouter-liste-course/{id}", name="add")
     */
    public function add(Recipe $recipe, ShopListRepository $shopListRepo)
    {
        // récupération des produits de la recette selectionné par l'utilisateur
        $recipeProducts = $recipe->getRecipeProducts();

        // Pour chaque produit de la recette 
        foreach ($recipeProducts as $recipeProduct) {
            // appel du manager
            $entityManager = $this->getDoctrine()->getManager();

            // vérification de l'existance du produit de la recette dans la liste de course de l'utilisateur
            if ($shopListRepo->findBy([
                'user' => $this->getUser(),
                'product' => $recipeProduct->getProduct()
            ])) {
                // récupération de la ligne
                $currentShopList = $shopListRepo->findOneBy([
                    'user' => $this->getUser(),
                    'product' => $recipeProduct->getProduct()
                ]);
                // récupération de la quantité enregistré 
                $oldQuantity = $currentShopList->getQuantity();
                // ajout de la quantité de la recette à la quantité de la liste de course 
                $newQuantity = $oldQuantity + $recipeProduct->getQuantity();
                // Set de la quantité
                $currentShopList->setQuantity($newQuantity);
                $entityManager->persist($currentShopList);
            } else {
                // Si le produit n'existe pas dasn la liste de course, on le créé
                $newShopList = new ShopList;
                // Set du produit
                $newShopList->setProduct($recipeProduct->getProduct());
                // set de la quantité
                $newShopList->setQuantity($recipeProduct->getQuantity());
                $newShopList->setUser($this->getUser());
                $entityManager->persist($newShopList);
            }
        
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_recipe_home');
    }

    /**
     * @Route("/vider-ma-liste", name="clean")
     */
    public function clean(ShopListRepository $shopListRepo)
    {
        $shopLists = $shopListRepo->findBy([
            'user' => $this->getUser()
        ]);

        foreach ($shopLists as $shopList) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($shopList);
            $entityManager->flush();
        }

        $this->addFlash(
            'danger',
            'Suppression(s) effectuée(s)'
        );

        return $this->redirectToRoute('app_shopList_home');
    }

    /**
     * @Route("/ajouter-au-frigo", name="stow")
     */
    public function stow(ShopListRepository $shopListRepo, UserProductRepository $userProductRepo)
    {
        // récupérer les produits dans la liste de course de l'utilisateur
        $shopLists = $shopListRepo->findBy([
            'user' => $this->getUser()
        ]);

        $entityManager = $this->getDoctrine()->getManager();

        // Pour chaque produit de la liste de course
        foreach ($shopLists as $shopList) {

            // Si le produit de la liste est déjà présent dans le frigo de l'utilisateur
            if ($userProductRepo->findOneBy([
                'user' => $this->getUser(),
                'product' => $shopList->getProduct()
            ])) {
                $userProduct = $userProductRepo->findOneBy([
                    'user' => $this->getUser(),
                    'product' => $shopList->getProduct()
                ]);
                // Modification de la quantité dans le frigo en fonction de la quantité sur la liste de course
                $userProduct->setQuantity($userProduct->getQuantity() + $shopList->getQuantity());
                $entityManager->persist($userProduct);
            // Si le produit n'existe pas dans le frigo
            } else {
                // création d'une nouvelle ligne
                $userProduct = new UserProduct();
                $userProduct->setUser($this->getUser());
                $userProduct->setQuantity($shopList->getQuantity());
                $userProduct->setProduct($shopList->getProduct());
                $entityManager->persist($userProduct);
            }

            // On enlève les produits de la liste de course
            $entityManager->remove($shopList);

            // Enregistrement en BDD
            $entityManager->flush();
        }

        $this->addFlash(
            'success',
            'Vos produits sont bien rangés dans le frigo'
        );
        
        return $this->redirectToRoute('app_shopList_home');
    }


    /**
     * @Route("/supprimer-de-ma-liste/{id}", name="delete")
     */
    public function delete(ShopListRepository $shopListRepo, Product $product)
    {
        $shopList = $shopListRepo->findOneBy([
            'user' => $this->getUser(),
            'product' => $product
        ]);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($shopList);
        $entityManager->flush();

        $this->addFlash(
            'danger',
            'Suppression(s) effectuée(s)'
        );

        return $this->redirectToRoute('app_shopList_home');
    }


}
