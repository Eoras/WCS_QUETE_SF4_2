<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route(name="tag_")
 */
class TagController extends AbstractController
{
    /**
     * @Route("/tag", name="showAll")
     */
    public function showAll(TagRepository $repository)
    {
        $tags = $repository->findAll();

        return $this->render('tag/showAll.html.twig', [
            'tags' => $tags,
        ]);
    }

    /**
     * @Route("/tag/{name}", name="showOne")
     */
    public function showOne(Tag $tag)
    {
        return $this->render('tag/showOne.html.twig', [
            'tag' => $tag,
        ]);
    }
}
