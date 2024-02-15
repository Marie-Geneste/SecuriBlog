<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Comment;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

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

        $marie = new User();
        $marie->setEmail('marie.eyremandi@gmail.com');
        $hash = $this->passwordHasher->hashPassword($marie, 'azerty');
        $marie->setPassword($hash);
        $marie->setPseudo('Naya');
        $manager->persist($marie);

        $comment_injsql_marie = new Comment();
        $comment_injsql_marie -> setContent("Trop bien l'article : trop cool le frérot !");
        $comment_injsql_marie -> setStatus(true);
        $comment_injsql_marie -> setDate(new DateTime());
        $comment_injsql_marie -> setArticle($article_injsql);
        $comment_injsql_marie -> setUser($marie);
        $manager->persist($comment_injsql_marie);


        $manager->flush();
    }
}
