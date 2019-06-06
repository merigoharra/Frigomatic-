<?php

// Le UserProduct correspond au "Frigo" de l'utilisateur. Il fait un lien entre l'utilisateur et les produits disponible dans la BDD

namespace App\Controller;

use App\Entity\Product;
use App\Entity\UserProduct;
use App\Form\UserProductType;
use App\Repository\ProductRepository;
use App\Repository\UserProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/application/mon-frigo", name="app_userProduct_")
 */
class UserProductController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(ProductRepository $productRepo, Request $request, UserProductRepository $userProductRepo)
    {
        // Methode index permet d'afficher la page d'accueil mais aussi le form d'ajout d'un produit en fonction d'une quantité dans le frigo (nouvelle ligne dans la table userProduct)

        // Création de l'objet et association avec un formulaire
        $newUserProduct = new UserProduct();
        $form = $this-> createForm(UserProductType::class, $newUserProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            // Récupération du produit en court d'ajout
            $currentProduct = $newUserProduct->getProduct();

            // Récupération de l'utilisateur courant 
            $user = $this->getUser();

            // Set de l'utilisateur avec l'utilisateur courant de l'app
            $newUserProduct->setUser($user);
            
            $quantityToAdd = $newUserProduct->getQuantity();

            // Vérification de l'existance d'une ligne identique dans la BDD pour faire une incrémentation plutot qu'un ajout
            if ($userProductRepo->findOneBy([
                'user' => $user,
                'product' => $currentProduct
            ])) {
                $newUserProduct = $userProductRepo->findOneBy([
                    'user' => $user,
                    'product' => $currentProduct
                ]);
                $quantity = $newUserProduct->getQuantity();
                $quantity = $quantity + $quantityToAdd;
                $newUserProduct->setQuantity($quantity);
            } 
            // Enregistrement de l'objet en BDD
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUserProduct);
            $entityManager->flush();

            // message flash de confirmation
            $this->addFlash(
                'success',
                'Votre produit est bien ajouté'
            );

            return $this->redirectToRoute('app_userProduct_home');
        }

        return $this->render('user_product/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajouter-au-frigo/{id}", name="add")
     */
    public function add(Product $product, UserProductRepository $userProductRepo)
    {
        // Route permettant d'ajouter un produit rapidement dasn le frigo 
        // Non utilisé pour le moment mais peut servir en AJAX peut être 

        if($userProductRepo->findOneBy([
            'user' => $this->getUser(),
            'product' => $product
        ])) {
            $userProduct = $userProductRepo->findOneBy([
                'user' => $this->getUser(),
                'product' => $product
            ]);
            $quantity = $userProduct->getQuantity();
            $quantity++;
            $userProduct->setQuantity($quantity);
        
        } else {
        $userProduct = new UserProduct;
        $userProduct->setProduct($product);
        $userProduct->setQuantity(1);
        $userProduct->setUser($this->getUser());
        }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userProduct);
        $entityManager->flush();
        
        $this->addFlash(
            'success',
            'Produit ajouté'
        );

        return $this->redirectToRoute('app_userProduct_home');
    }

    /**
     * @Route("/{id}", name="delete", methods={"DELETE"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, UserProduct $userProduct): Response
    {
        // Méthode permettant de supprimer un produit du Frigo

        if ($this->isCsrfTokenValid('delete'.$userProduct->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userProduct);
            $entityManager->flush();

            $this->addFlash(
                'danger',
                'Suppression effectuée'
            );
        }

        return $this->redirectToRoute('app_userProduct_home');
    }
}
