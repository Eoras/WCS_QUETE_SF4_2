<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Form\ArticleSearchType;
use App\Form\ArticleType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog_index")
     */
    public function index(Request $request)
    {
        $searchForm = $this->createForm(ArticleSearchType::class);

        $searchForm->handleRequest($request);
        if ($searchForm->isSubmitted()) {
            $data = $searchForm->getData();
            echo "La recherche sera bientôt disponible ;)<br>";
        }

        $article = new Article();
        $formNewArticle = $this->createForm(ArticleType::class, $article);
        $formNewArticle->handleRequest($request);

        if ($formNewArticle->isSubmitted() && $formNewArticle->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($article);
            $em->flush();

            return $this->redirectToRoute('blog_index');
        }

        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        // Vérification si aucune catégorie:
        $categories = count($this->getDoctrine()
            ->getRepository(Category::class)
            ->findAll());
        if (!$categories) {
            throw $this->createNotFoundException(
                'No category found in category\'s table. Go to /category route to add one.'
            );
        }

        return $this->render(
            'blog/showAll.html.twig', [
                'articles' => $articles,
                'formSearch' => $searchForm->createView(),
                'formNewArticle' => $formNewArticle->createView()
            ]
        );
    }


    /**
     * Getting a article with a formatted slug for title
     *
     * @param string $slug The slugger
     *
     * @Route("/blog/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     * @return Response A response instance
     */
    public function show(string $slug): Response
    {
        if (!$slug) {
            throw $this
                ->createNotFoundException('No slug has been sent to find an article in article\'s table.');
        }

        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );

        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title' => mb_strtolower($slug)]);

        if (!$article) {
            throw $this->createNotFoundException(
                'No article with ' . $slug . ' title, found in article\'s table.'
            );
        }

        return $this->render(
            'blog/showOne.html.twig',
            [
                'article' => $article,
                'slug' => $slug,
            ]
        );
    }

}
