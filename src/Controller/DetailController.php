<?php

namespace App\Controller;

use App\Entity\Articles;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DetailController extends AbstractController
{
    /**
     * @Route("/detail/{id}", name="detail_article_id")
     */
    public function index($id)
    {
        $detail = $this->getDoctrine()
            ->getRepository(Articles::class)
            ->find($id);

        return $this->render('detail/index.html.twig', [
            'detail' => $detail,
        ]);
    }
}
