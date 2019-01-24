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
     * @Route("/{id}", name="show")
     */
    public function index(Article $article)
    {
        return $this->render('article/show.html.twig', [
            'article' => $article
        ]);
    }
}
