<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalendarController extends AbstractController
{
    /**
     * @Route("/calendar", name="calendar")
     */
    public function calendar(Booking $booking = null, Request $request): Response
    {
        $form = $this->createform(BookingType::class, $booking,[
            'method' => 'POST',
            'attr'=>[
                'id'=>'bookingForm'
            ]
        ]);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute("calendar");
        }

        return $this->render('calendar/index.html.twig',[
            'bookingForm' => $form->createView(),
        ]);
    }
}