<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $category_attaque = new Category();
        $category_attaque -> setName("Attaque");
        $manager->persist($category_attaque);

        $category_defense = new Category();
        $category_defense -> setName("Défense");
        $manager->persist($category_defense);

        $article_injsql = new Article();
        $article_injsql -> setTitle("Injection SQL");
        $article_injsql -> setDescription("Un pirate va essayer de lancer une requête SQL grâce à une potentielle faille dans une des requêtes de l'application.");
        $article_injsql -> setImage("https://www.nilebits.com/wp-content/uploads/2020/10/sql-injection.png");
        $article_injsql -> setDate(new DateTime());
        $article_injsql -> setCategory($category_attaque);
        $manager->persist($article_injsql);

        $manager->flush();
    }
}
