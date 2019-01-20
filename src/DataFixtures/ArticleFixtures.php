<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker  =  Faker\Factory::create('fr_FR');

        for($i=0; $i<5; $i++) {
            for($j=0; $j<10; $j++) {
                $article = new Article();
                $article->setCategory($this->getReference('categorie_'.$i));
                $article->setTitle(mb_strtolower($faker->sentence()));
                $article->setContent($faker->text());
                $manager->persist($article);
            }
        }

        $manager->flush();

    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }
}
