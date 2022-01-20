<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\News;
use App\Form\ContactType;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(HttpClientInterface $client, EventRepository $events_repo, NewsRepository $news_repo): Response
    {
        // Get weather at LeCaire
        $response = $client->request('POST', 'https://api.openweathermap.org/data/2.5/weather?q=le+caire&units=metric&lang=fr&appid='.$_ENV['WEATHER_API_KEY']);
        $weather = $response->toArray();

        return $this->render('main/home.html.twig',[
            'weather' => $weather,
            'events' => $events_repo->findAll(),
            'news' => $news_repo->findAll(),
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
    public function contact(Request $request): Response {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->addFlash('success','Message envoyé avec succès !');
            return $this->redirectToRoute('contact');
        }


        return $this->render('main/contact.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/event/{id}", name="show_event")
     */
    public function show_event_byid(Event $event): Response {
        return $this->render('main/article.html.twig',[
            'article' => $event,
        ]);
    }

    /**
     * @Route("/new/{id}", name="show_new")
     */
    public function show_new_byid(News $new): Response {
        return $this->render('main/article.html.twig',[
            'article' => $new,
        ]);
    }
}
