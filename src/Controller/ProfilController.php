<?php

namespace App\Controller;

use App\Repository\CommentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommentRepository $CommentRepository): Response
    {
        $pageActive = 'profil';
        $commentFromUser = $CommentRepository->findBy(['user'=> $this->getUser()]);
        return $this->render('profil/index.html.twig', [
            'pageActive' => $pageActive,
            'comments' => $commentFromUser
        ]);
    }
}
