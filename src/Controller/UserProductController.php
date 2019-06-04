<?php

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

        $newUserProduct = new UserProduct();
        $form = $this-> createForm(UserProductType::class, $newUserProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $currentProduct = $newUserProduct->getProduct();

            $newUserProduct->setUser($this->getuser());

            if ($this->getuser()->getUserProducts()->findByProduct($currentProduct)) {
                $NewUserProduct = $this->getuser()->getUserProducts()->findOneByProduct($currentProduct);
                $quantity = $newUserProduct->getQuantity();
                $quantity++;
                $newUserProduct->setQuantity($quantity);
            } 
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newUserProduct);
            $entityManager->flush();

            $this->addFlash(
                'success',
                'Votre produit est bien ajouté'
            );

            return $this->redirectToRoute('app_userProduct_home');
        }

        $allProducts = $productRepo->findAll();
        return $this->render('user_product/index.html.twig', [
            'allProducts' => $allProducts,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/ajouter-au-frigo/{id}", name="add")
     */
    public function add(Product $product, UserProductRepository $userProductRepo)
    {
        if($userProductRepo->findOneByProduct($product)) {
            $userProduct = $userProductRepo->findOneByProduct($product);
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
