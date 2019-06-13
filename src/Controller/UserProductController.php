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
use App\Repository\CategoryRepository;

/**
 * @Route("/application/mon-frigo", name="app_userProduct_")
 */
class UserProductController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, UserProductRepository $userProductRepo, CategoryRepository $categoryRepo)
    {
        // Methode index permet d'afficher la page d'accueil mais aussi le form d'ajout d'un produit en fonction d'une quantité dans le frigo (nouvelle ligne dans la table userProduct)

        // Création de l'objet et association avec un formulaire
        $newUserProduct = new UserProduct();
        $form = $this-> createForm(UserProductType::class, $newUserProduct);
        $form->handleRequest($request);

        // Je récupére toutes les catégories pour les envoyer à la vue 
        $categories = $categoryRepo->findAll();

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
                $newUserProduct->setUpdatedAt(new \DateTime());
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
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/ajouter-au-frigo/{id}/{action}", name="add")
     */
    public function addRemove(Product $product, UserProductRepository $userProductRepo, $action)
    {
        // Route permettant d'ajouter un produit rapidement dans le frigo 
        if($userProductRepo->findOneBy([
            'user' => $this->getUser(),
            'product' => $product
        ])) {
            $userProduct = $userProductRepo->findOneBy([
                'user' => $this->getUser(),
                'product' => $product
            ]);
            $quantity = $userProduct->getQuantity();
            if ($action == 'add') {
                $quantity++;
                $userProduct->setUpdatedAt(new \DateTime());
            } else {
                $quantity--;
            }
            $userProduct->setQuantity($quantity);
        } 
        // le tchat de youness : bac +5 t'a pas besoin de chercher lol
        // else {
        // $userProduct = new UserProduct;
        // $userProduct->setProduct($product);
        // $userProduct->setQuantity(1);
        // $userProduct->setUser($this->getUser());
        // }
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($userProduct);
        $entityManager->flush();

        // return $this->redirectToRoute('app_userProduct_home');
        return $this->json(['code' => 200, 'quantity' => $quantity, 'message' => '+1 ok'], 200);
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


    /**
     * @Route("/ajouter-quantite-dans-le-frigo/{id}", name="addOrRemove")
     */
    public function addRemoveQuantity(Request $request, UserProductRepository $repo, Product $product)
    {
        // ************ Tests pour le passage par axios *****************
        // $data = $request->getContent();
        // $data = json_decode($data, true);

        // $quantityToAdd = $data->quantityToAdd;
        // $quantityToRemove = $data->quantityToRemove;
        // **************************************************************

        $quantityToAdd = $request->request->get("quantityToAdd");
        $quantityToRemove =  $request->request->get("quantityToRemove");

        $userProduct = $repo->findOneBy([
            'user' => $this->getUser(),
            'product' => $product,
        ]);
        if (empty($quantityToAdd )) {
            $quantityToAdd = 0;
        };
        if (empty($quantityToRemove)) {
            $quantityToRemove = 0;
        };
        $quantity = $userProduct->getQuantity();
        $quantity = $quantity + ($quantityToAdd - $quantityToRemove);

        $entityManager = $this->getDoctrine()->getManager();

        if ($quantity <= 0 ) {
            $entityManager->remove($userProduct);
        } 
        else {
            $userProduct->setQuantity($quantity);
            $userProduct->setUpdatedAt(new \DateTime());
            $entityManager->persist($userProduct);
        } 
        $entityManager->flush();

        return $this->redirectToRoute('app_userProduct_home');

        // ************ Tests pour le passage par axios *****************
        // return $this->json(['code' => 200, 'quantity' => $quantity, 'message' => 'Mise a jour ok'], 200);
        // **************************************************************

        
    }
}