<?php

// Controller de l'accueil de l'application (une fois l'utilisateur connecté)

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/application", name="app_")
 */
class ApplicationController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        // SELECT  FROM `recipe_product` WHERE `product_id` IN( SELECT `product_id` FROM `user_product`)

        // SELECT recipe_id FROM `recipe_product` WHERE `product_id` IN (SELECT `product_id` FROM `user_product` WHERE `user_id` = 1) GROUP BY recipe_id HAVING COUNT(product_id) > 4


        // Stoker dans une variable tous les ID des produits présent dasn la table user_product de l'utilisateur

        // Faire une requête sql pour trouver les recettes ayant des productId correspondant à notre variable

        return $this->render('application/index.html.twig', [

        ]);
    }
}
