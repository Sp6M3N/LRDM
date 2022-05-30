<?php

namespace App\Controller;

use App\Entity\EventPost;
use App\Form\EventPostType;
use App\Repository\EventPostRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/event/post")
 */
class EventPostController extends AbstractController
{
    /**
     * @Route("/", name="app_event_post_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(EventPostRepository $eventPostRepository): Response
    {
        return $this->render('event_post/index.html.twig', [
            'event_posts' => $eventPostRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_event_post_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EventPostRepository $eventPostRepository): Response
    {
        $eventPost = new EventPost();
        $form = $this->createForm(EventPostType::class, $eventPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventPostRepository->add($eventPost);
            return $this->redirectToRoute('app_event_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_post/new.html.twig', [
            'event_post' => $eventPost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_post_show", methods={"GET"})
     */
    public function show(EventPost $eventPost): Response
    {
        return $this->render('event_post/show.html.twig', [
            'event_post' => $eventPost,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_event_post_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, EventPost $eventPost, EventPostRepository $eventPostRepository): Response
    {
        $form = $this->createForm(EventPostType::class, $eventPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $eventPostRepository->add($eventPost);
            return $this->redirectToRoute('app_event_post_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('event_post/edit.html.twig', [
            'event_post' => $eventPost,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_event_post_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, EventPost $eventPost, EventPostRepository $eventPostRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$eventPost->getId(), $request->request->get('_token'))) {
            $eventPostRepository->remove($eventPost);
        }

        return $this->redirectToRoute('app_event_post_index', [], Response::HTTP_SEE_OTHER);
    }
}
