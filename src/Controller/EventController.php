<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    private $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    #[Route('/api/getAllEvents', name: 'get_all_events', methods: ['GET'])]
    public function index(): Response
    {
        $events = $this->eventRepository->getAllEvents();

        return $this->json($events);
    }

    #[Route('/api/getEventByActivity/{activity}', name: 'get_event_by_activity', methods: ['GET'])]
    public function getEventByActivity($activity): Response
    {
        $events = $this->eventRepository->getEventByActivity($activity);

        return $this->json($events);
    }

    #[Route('/api/getEventOrderByStartDate', name: 'get_event_order_by_start_date', methods: ['GET'])]
    public function getEventOrderByStartDate(): Response
    {
        $events = $this->eventRepository->getEventOrderByStartDate();

        return $this->json($events);
    }
}
