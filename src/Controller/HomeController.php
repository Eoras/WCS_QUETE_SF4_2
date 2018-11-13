<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {

        $em = $this->getDoctrine()->getManager();
        $categories = $em->getRepository(Category::class)->findAll();

        if(count($categories) <= 0) {
            for ($i = 0; $i < 3; $i++) {
                $category = new Category();
                $category->setName('Category ' . $i);
                $em->persist($category);
            }
            $em->flush();
            $categories = $em->getRepository(Category::class)->findAll();

            for ($i = 0; $i < 10; $i++) {
                $article = new Article();
                $article->setTitle("Title " . $i);
                $article->setContent("Content " . $i);
                $article->setCategory($categories[array_rand($categories)]);
                $em->persist($article);
            }
            $em->flush();
        }


        return $this->render('home.html.twig', [
            'catagories' => $categories
        ]);
    }
}
