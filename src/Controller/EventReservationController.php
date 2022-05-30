<?php

namespace App\Controller;

use App\Entity\EventReservation;
use App\Form\EventReservationType;
use App\Repository\EventReservationRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event/reservation")
 * @IsGranted("ROLE_ADMIN")
 */
class EventReservationController extends AbstractController
{
    /**
     * @Route("/", name="app_event_reservation_index", methods={"GET"})
     */
    public function index(EventReservationRepository $eventReservationRepository): Response
    {
        return $this->render('event_reservation/index.html.twig', [
            'event_reservations' => $eventReservationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_event_reservation_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EventReservationRepository $eventReservationRepository): Response
    {
        $eventReservation = new EventReservation();
        $form = $this->createForm(EventReservationType::class, $eventReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventReservationRepository->add($eventReservation);
            return $this->redirectToRoute('app_event_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_reservation/new.html.twig', [
            'event_reservation' => $eventReservation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_reservation_show", methods={"GET"})
     */
    public function show(EventReservation $eventReservation): Response
    {
        return $this->render('event_reservation/show.html.twig', [
            'event_reservation' => $eventReservation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_event_reservation_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, EventReservation $eventReservation, EventReservationRepository $eventReservationRepository): Response
    {
        $form = $this->createForm(EventReservationType::class, $eventReservation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventReservationRepository->add($eventReservation);
            return $this->redirectToRoute('app_event_reservation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_reservation/edit.html.twig', [
            'event_reservation' => $eventReservation,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_reservation_delete", methods={"POST"})
     */
    public function delete(Request $request, EventReservation $eventReservation, EventReservationRepository $eventReservationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventReservation->getId(), $request->request->get('_token'))) {
            $eventReservationRepository->remove($eventReservation);
        }

        return $this->redirectToRoute('app_event_reservation_index', [], Response::HTTP_SEE_OTHER);
    }
}
