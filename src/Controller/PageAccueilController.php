<?php

namespace App\Controller;

use App\Repository\AdvertRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageAccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil", methods={"GET"})
     */
    public function index(): Response
    {
        $titrepage = "Accueil";

       return $this->render('accueil.html.twig', [
            'title' => $titrepage
        ]);
    }

}
