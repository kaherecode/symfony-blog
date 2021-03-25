<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin",)
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/", name="admin")
     */
    public function index(
        ArticleRepository $articleRepository,
        UserRepository $userRepository
    ): Response {
        $articles = $articleRepository->findBy([], ['updatedAt' => 'DESC']);
        $users = $userRepository->findAll();

        return $this->render(
            'admin/index.html.twig',
            compact('articles', 'users')
        );
    }
}
