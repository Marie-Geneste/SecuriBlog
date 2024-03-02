<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Form\CommentType;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main', methods: ['GET'])]
    public function index(ArticleRepository $ArticleRepository, CategoryRepository $CategoryRepository): Response
    {
        $pageActive = 'home';
        
        $articles = $ArticleRepository->findAll();

        $categories = $CategoryRepository->findAll();

        return $this->render('main/index.html.twig', [
            'pageActive' => $pageActive,
            'articles' => $articles,
            'categories' => $categories
        ]);
    }

    #[Route('/articleByCategory/{id}', name: 'app_articleByCategory', methods: ['GET'])]
    public function articleByCategory($id, ArticleRepository $ArticleRepository, CategoryRepository $CategoryRepository): Response
    {
        $pageActive = 'home';

        $categories = $CategoryRepository->findAll();

        $articlesByCategory = $ArticleRepository->findBy(['category' => $id]);

        return $this->render('main/index.html.twig', [
            'pageActive' => $pageActive,
            'articles' => $articlesByCategory,
            'categories' => $categories
        ]);
    }

    #[Route('/articleById/{id}', name: 'app_articleById', methods: ['GET', 'POST'])]
    public function articleById($id, ArticleRepository $ArticleRepository, CommentRepository $CommentRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        $pageActive = 'home';
        $article = $ArticleRepository->find($id);
        $comments = $CommentRepository->findBy(['article' => $id]);
        $comment = new Comment();
        $comment->setArticle($article); 
        $comment->setUser($this->getUser()); 
        $comment->setStatus(true); 
        $comment->setDate(new \DateTime());
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($comment);
            $entityManager->flush();
            
            return $this->redirectToRoute('app_articleById', ['id' => $id], Response::HTTP_SEE_OTHER);
        }

        return $this->render('article/article.html.twig', [
            'pageActive' => $pageActive,
            'article' => $article,
            'comments' => $comments,
            'comment' => $comment,
            'form' => $form,
        ]);
    }
}
