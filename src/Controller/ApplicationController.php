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
        return $this->render('application/index.html.twig', [

        ]);
    }
}
