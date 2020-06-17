<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Marques;
use App\Entity\Categories;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AddController extends AbstractController
{
    /**
     * @Route("/add", name="add_article")
     */
    public function ajouter(Request $request)
    {
        $article = new Articles();

        $form = $this->createFormBuilder($article)
           ->add('nom', TextType::class)
           ->add('description', TextType::class)
           ->add('reference', TextType::class)
           ->add('marque', EntityType::class, [
               'class' => Marques::class,
               'choice_label' => 'nom',
           ])
           ->add('categorie', EntityType::class, [
               'class' => Categories::class,
               'choice_label' => 'nom',
           ])
           ->add('quantite', NumberType::class)
           ->add('save', SubmitType::class, ['label' => 'Valider'])
           ->getForm();

           $form->handleRequest($request);
           if ($form->isSubmitted() && $form->isValid()) {
               $article = $form->getData();
               $entityManager = $this->getDoctrine()->getManager();
               $entityManager->persist($article);
               $entityManager->flush();
           }

        return $this->render('add/index.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }
}
