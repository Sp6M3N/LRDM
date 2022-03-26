<?php

namespace App\Controller;

use App\Entity\NewLetter;
use App\Form\NewLetterType;
use App\Repository\NewLetterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/new/letter")
 */
class NewLetterController extends AbstractController
{
    /**
     * @Route("/", name="app_new_letter_index", methods={"GET"})
     */
    public function index(NewLetterRepository $newLetterRepository): Response
    {
        return $this->render('new_letter/index.html.twig', [
            'new_letters' => $newLetterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_new_letter_new", methods={"GET", "POST"})
     */
    public function new(Request $request, NewLetterRepository $newLetterRepository): Response
    {
        $newLetter = new NewLetter();
        $form = $this->createForm(NewLetterType::class, $newLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newLetterRepository->add($newLetter);
            return $this->redirectToRoute('app_new_letter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('new_letter/new.html.twig', [
            'new_letter' => $newLetter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_new_letter_show", methods={"GET"})
     */
    public function show(NewLetter $newLetter): Response
    {
        return $this->render('new_letter/show.html.twig', [
            'new_letter' => $newLetter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_new_letter_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, NewLetter $newLetter, NewLetterRepository $newLetterRepository): Response
    {
        $form = $this->createForm(NewLetterType::class, $newLetter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newLetterRepository->add($newLetter);
            return $this->redirectToRoute('app_new_letter_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('new_letter/edit.html.twig', [
            'new_letter' => $newLetter,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_new_letter_delete", methods={"POST"})
     */
    public function delete(Request $request, NewLetter $newLetter, NewLetterRepository $newLetterRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$newLetter->getId(), $request->request->get('_token'))) {
            $newLetterRepository->remove($newLetter);
        }

        return $this->redirectToRoute('app_new_letter_index', [], Response::HTTP_SEE_OTHER);
    }
}
