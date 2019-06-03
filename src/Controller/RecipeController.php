<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\RecipeRepository;

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
        $form = $this-> createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

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
}
