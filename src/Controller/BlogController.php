<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(): Response
    {
        return $this->render('blog/index.html.twig');
    }

    /**
     * @Route("/add", name="add_article")
     */
    public function add(Request $request)
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // on récupère l'entity manager qui va nous permettre d'interagir avec la BDD
            $em = $this->getDoctrine()->getManager();

            // on confie l'objet $article à l''entity manager (on le persiste)
            $em->persist($article);

            // on exécute la requête en base de données
            $em->flush();

            return new Response("L'article a bien été enregitrer.");
        }

        return $this->render(
            'blog/add.html.twig',
            ['form' => $form->createView()]
        );
    }

    /**
     * @Route("/edit/{url}", name="edit_article")
     */
    public function edit(string $url)
    {
        return $this->render('blog/edit.html.twig', ['slug' => $url]);
    }

    /**
     * @Route("/show/{url}", name="show_article")
     */
    public function show(string $url)
    {
        return $this->render('blog/show.html.twig', ['slug' => $url]);
    }

    /**
     * @Route("/delete/{url}", name="delete_article")
     */
    public function delete(string $url)
    {
        return new Response("<h1>Contrôleur pour supprimer l'article: $url</h1>");
    }
}
