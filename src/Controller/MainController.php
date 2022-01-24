<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\News;
use App\Form\ContactType;
use App\Repository\EventRepository;
use App\Repository\NewsRepository;
use App\Service\Captcha;
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
        $form = $this->createForm(ContactType::class,[
            'method' => 'POST',
            'attr' => [
                'id' => 'demo-form'
            ]
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $captcha = new Captcha($_POST['g-recaptcha-response']);
            if($captcha->captchaIsValid()){
                $this->addFlash('success','Message envoyé avec succès !');
            }else{
                $this->addFlash('error','Captcha invalide !');
            }
            return $this->redirectToRoute('contact');
        }

        return $this->render('main/contact.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request): Response {
        $post = $request->request->get("search");
        if($post != ""){
            return $this->render('main/search.html.twig',[
                'search' => $post,
            ]);
        }else{
            return $this->redirectToRoute("home");
        }
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
