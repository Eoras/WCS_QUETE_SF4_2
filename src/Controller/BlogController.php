<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/blog", name="blog_")
 */
class BlogController extends AbstractController
{
    /**
     * @Route("/{slug<([a-z0-9-]*)>}", name="show")
     */
    public function show(string $slug)
    {
        $slug = ucwords(
            str_replace("-", " ", $slug)
        );

        return $this->render('blog/show.html.twig', [
            'slug' => $slug,
        ]);
    }
}
