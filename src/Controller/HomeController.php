<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Marques;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home()
    {
        // Recuperer en base de données les articles

        $articles = $this->getDoctrine()
        ->getRepository(Articles::class)
        ->findAll();

        return $this->render('home/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
