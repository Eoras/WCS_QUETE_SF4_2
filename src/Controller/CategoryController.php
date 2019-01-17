<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\ArticleType;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/category", name="category_")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", name="showAll")
     */
    public function showAll(Request $request, EntityManagerInterface $manager)
    {
        $categories = $manager->getRepository(Category::class)->findAll();

        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($category);
            $manager->flush();

            return $this->redirectToRoute('category_showAll');
        }

        return $this->render('category/showAll.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
            'category' => $category
        ]);
    }

    /**
     * @Route("/{name}", name="showAllArticles")
     */
    public function showOne(Category $category)
    {

        return $this->render('category/showOne.twig', [
            'category' => $category
        ]);
    }

}
