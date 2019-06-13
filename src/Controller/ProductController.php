<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RecipeProductRepository;

/**
 * @Route("/application/Produit/{id}", name="app_product_")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Product $product, RecipeProductRepository $recipeProductRepo)
    {
        $recipeProducts = $recipeProductRepo->findBy([
            'product' => $product
        ]);

        return $this->render('product/index.html.twig', [
            'recipeProducts' => $recipeProducts
        ]);
    }
}
