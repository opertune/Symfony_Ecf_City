<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(ArticleRepository $article_repo, HttpClientInterface $client): Response
    {
        // Get weather at LeCaire
        $response = $client->request('POST', 'https://api.openweathermap.org/data/2.5/weather?q=le+caire&units=metric&lang=fr&appid='.$_ENV['WEATHER_API_KEY']);
        $weather = $response->toArray();
        // Get all article by categorie name
        $events = $article_repo->findByCategorie('Évènement');
        $news = $article_repo->findByCategorie('Actualite');
        return $this->render('main/home.html.twig',[
            'events' => $events,
            'news' => $news,
            'weather' => $weather,
        ]);
    }

    /**
     * @Route("/histoire", name="history")
     */
    public function histoire(): Response {
        return $this->render('main/histoire.html.twig');
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact(): Response {
        return $this->render('main/contact.html.twig');
    }

    /**
     * @Route("/rendezvous", name="dating")
     */
    public function dating(): Response {
        return $this->render('main/dating.html.twig');
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function admin(): Response {
        return $this->render('main/admin.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response {
        return $this->render('main/login.html.twig');
    }

    /**
     * @Route("/article/{id}", name="show_article")
     */
    public function show_event_byid(Article $article): Response {
        return $this->render('main/article.html.twig', [
            'article' => $article,
        ]);
    }
}
