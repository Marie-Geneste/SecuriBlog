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
        $category_attaque -> setColor("AC2BB7");
        $manager->persist($category_attaque);

        $category_defense = new Category();
        $category_defense -> setName("Défense");
        $category_defense -> setColor("3E2BB7");
        $manager->persist($category_defense);

        $article_injsql = new Article();
        $article_injsql -> setTitle("Injection SQL");
        $article_injsql -> setDescription("Un pirate va essayer de lancer une requête SQL grâce à une potentielle faille dans une des requêtes de l'application. Le SQL (Structured Query Language) est un langage de programmation conçu pour les données stockées dans un système de gestion des flux de données relationnelles. Les requêtes SQL exécutent des commandes visant notamment à récupérer et à mettre à jour des données, ainsi qu’à supprimer des registres. Pour exécuter ces commandes malveillantes, le cyberattaquant peut insérer du code malveillant dans des chaînes envoyées au serveur SQL à des fins d’exécution. Les utilisateurs malveillants peuvent lancer une attaque de plusieurs manières, mais les champs de saisie à texte libre des formulaires constituent des vulnérabilités courantes des applications web ou des pages web.");
        $article_injsql -> setImage("https://www.nilebits.com/wp-content/uploads/2020/10/sql-injection.png");
        $article_injsql -> setDate(new DateTime());
        $article_injsql -> setCategory($category_attaque);
        $manager->persist($article_injsql);

        $article_injsqldef = new Article();
        $article_injsqldef -> setTitle("Défense contre les injections SQL");
        $article_injsqldef -> setDescription("Utilisation d’instructions préparées et de requêtes paramétrées. Lorsqu’un développeur utilise des requêtes paramétrées, il doit définir l’intégralité du code SQL, puis passer chaque paramètre. Il est donc impossible pour un attaquant de modifier l’objet de la requête ultérieurement.");
        $article_injsqldef -> setImage("https://dytvr9ot2sszz.cloudfront.net/wp-content/uploads/2019/06/how_to_defend_yourself_agains_sql_injections_-_main.jpg");
        $article_injsqldef -> setDate(new DateTime());
        $article_injsqldef -> setCategory($category_defense);
        $manager->persist($article_injsqldef);

        $marie = new User();
        $marie->setEmail('marie.eyremandi@gmail.com');
        $hash = $this->passwordHasher->hashPassword($marie, 'azerty');
        $marie->setPassword($hash);
        $marie->setPseudo('Naya');
        $manager->persist($marie);

        $admin = new User();
        $admin->setEmail('nayade.hera@gmail.com');
        $adminHash = $this->passwordHasher->hashPassword($admin, 'admin');
        $admin->setPassword($adminHash);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setPseudo('BOSS');
        $manager->persist($admin);

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
