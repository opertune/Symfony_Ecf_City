<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendar(Request $request, EntityManagerInterface $entityManager): Response
    {
        $booking = new Booking();
        $form = $this->createform(BookingType::class, $booking,[
            'method' => 'POST',
            'attr'=>[
                'id'=>'bookingForm'
            ]
        ]);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($booking);
            $entityManager->flush();
            return $this->redirectToRoute("calendar");
        }

        return $this->render('calendar/index.html.twig',[
            'bookingForm' => $form->createView(),
        ]);
    }
}