<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\NewLetter;
use App\Form\NewLetterType;
use App\Repository\NewLetterRepository;
use DateTimeZone;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     * @throws Exception
     */
    public function index(EntityManagerInterface $manager, Request $request, NewLetterRepository $newLetterRepository): Response
    {
        $allEvents = $manager->getRepository(Event::class)->findBy([], ['eventDate' => 'ASC']);
        $curDate = new \DateTimeImmutable(null, new DateTimeZone('Europe/Paris'));
        $events = [];
        foreach ($allEvents as $event){
            if ($event->getEventDate() > $curDate){
                $events[] = $event;
            }
        }

        $newLetter = new NewLetter();
        $form = $this->createForm(NewLetterType::class, $newLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newLetterRepository->add($newLetter);
            return $this->redirectToRoute('app_new_letter_index', [], Response::HTTP_SEE_OTHER);
        }


        return $this->renderForm('home/index.html.twig', [
            'events' => $events,
            'new_letter' => $newLetter,
            'form' => $form,
        ]);
    }
}
