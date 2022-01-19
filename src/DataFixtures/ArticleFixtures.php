<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ArticleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category_title = [
            'Évènement', 'Actualité'
        ];
        $faker = \Faker\Factory::create('fr_FR');
        for($i = 0; $i < count($category_title); $i++){
            $catagory = new Category();
            $catagory->setTitle($category_title[$i]);
            $manager->persist($catagory);
            for($j = 1; $j <= mt_rand(6, 10); $j++){
                $article = new Article();
                $article->setTitle("Titre ".$category_title[$i]." {$j}")
                ->setDescription($faker->paragraph(15, false))
                ->setDate($faker->dateTimeBetween('-6 months', 'now'))
                ->setImage('http://picsum.photos/id/'.mt_rand(1,200).'/500/400')
                ->setCategory($catagory);
                $manager->persist($article);
            }
        }
        $manager->flush();
    }
}
