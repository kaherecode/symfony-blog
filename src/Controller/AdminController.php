<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 * @IsGranted("ROLE_MODERATOR")
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

    /**
     * @Route("/users/delete/{id}", name="admin_delete_user")
     */
    public function deleteUser(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return new Response("Suppresion de l'utilisateur {$user->getId()}");
    }
}
