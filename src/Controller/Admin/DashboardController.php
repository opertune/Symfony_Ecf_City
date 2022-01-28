<?php

namespace App\Controller\Admin;

use App\Entity\Booking;
use App\Entity\Event;
use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('dashboard/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
        ->setTitle('');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Administration', 'fas fa-home', 'admin');
        yield MenuItem::linktoRoute('Retour sur le site', 'fas fa-home', 'home');
        yield MenuItem::linkToCrud('Évènements', 'fa fa-comment', Event::class);
        yield MenuItem::linkToCrud('Actualités', 'fa fa-file-text', News::class);
        yield MenuItem::linkToCrud('Rendez-vous', 'fa fa-file-text', Booking::class);
    }
}
