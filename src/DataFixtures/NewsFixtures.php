<?php

namespace App\DataFixtures;

use App\Entity\News;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class NewsFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        for($i=0; $i<mt_rand(5,10); $i++){
            $new = new News();
            $new->setTitle("Actualité {$i}")
            ->setDescription($faker->paragraph(15))
            ->setImage('http://picsum.photos/id/'.mt_rand(1,200).'/400/300')
            ->setDate($faker->dateTimeBetween('-6 months', 'now'));
            $manager->persist($new);
        }

        $manager->flush();
    }
}
