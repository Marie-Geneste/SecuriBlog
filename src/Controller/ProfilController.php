<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\CommentRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(CommentRepository $CommentRepository, Request $request, UserRepository $user, EntityManagerInterface $entityManager): Response
    {
        $pageActive = 'profil';
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_profil', [], Response::HTTP_SEE_OTHER);
        }
        $commentFromUser = $CommentRepository->findBy(['user'=> $user]);
        return $this->render('profil/index.html.twig', [
            'pageActive' => $pageActive,
            'form' => $form,
            'user' => $user,
            'comments' => $commentFromUser
        ]);
    }
}
