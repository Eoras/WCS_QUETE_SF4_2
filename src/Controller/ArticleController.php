<?php

namespace App\Controller;

use App\Entity\Article;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/article", name="article_")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/{id}", name="showOne")
     */
    public function index(Article $article)
    {
        return $this->render('article/showOne.html.twig', [
            'article' => $article
        ]);
    }
}
