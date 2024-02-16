<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        
        $articles = $ArticleRepository->findAll();

        $categories = $CategoryRepository->findAll();

        $articlesByCategory = $ArticleRepository->findBy(['category' => $id]);

        return $this->render('main/index.html.twig', [
            'pageActive' => $pageActive,
            'articles' => $articlesByCategory,
            'categories' => $categories
        ]);
    }
}
