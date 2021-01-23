<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return new Response("<h1>Hello toi dev Symfony, bienvenue sur Kaherecode!</h1>");
    }

    /**
     * @Route("/add", name="add_article")
     */
    public function add()
    {
        return new Response("<h1>Contrôleur d'ajout d'un article</h1>");
    }

    /**
     * @Route("/edit/{url}", name="edit_article")
     */
    public function edit(string $url)
    {
        return new Response("<h1>Contrôleur pour modifier l'article: $url</h1>");
    }

    /**
     * @Route("/show/{url}", name="show_article")
     */
    public function show(string $url)
    {
        return new Response("<h1>Contrôleur pour afficher l'article: $url</h1>");
    }

    /**
     * @Route("/delete/{url}", name="delete_article")
     */
    public function delete(string $url)
    {
        return new Response("<h1>Contrôleur pour supprimer l'article: $url</h1>");
    }
}
