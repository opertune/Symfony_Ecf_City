<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        return $this->render('main/home.html.twig');
    }

    /**
     * @Route("/histoire", name="histoire")
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
}
