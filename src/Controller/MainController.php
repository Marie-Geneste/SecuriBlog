<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main', methods: ['GET'])]
    public function index(ArticleRepository $ArticleRepository): Response
    {
        $pageActive = 'home';
        $articles = $ArticleRepository->findAll();
        return $this->render('main/index.html.twig', [
            'pageActive' => $pageActive,
            'articles' => $articles
        ]);
    }
}
