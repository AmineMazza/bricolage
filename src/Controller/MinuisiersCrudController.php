<?php

namespace App\Controller;

use App\Entity\BricoleursMinuisiers;
use App\Form\BricoleursMinuisiersType;
use App\Repository\BricoleursMinuisiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/minuisiers')]
class MinuisiersCrudController extends AbstractController
{
    #[Route('/index', name: 'app_minuisiers_crud_index', methods: ['GET'])]
    public function index(BricoleursMinuisiersRepository $bricoleursMinuisiersRepository): Response
    {
        return $this->render('minuisiers_crud/index.html.twig', [
            'bricoleurs_minuisiers' => $bricoleursMinuisiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_minuisiers_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursMinuisiersRepository $bricoleursMinuisiersRepository): Response
    {
        $bricoleursMinuisier = new BricoleursMinuisiers();
        $form = $this->createForm(BricoleursMinuisiersType::class, $bricoleursMinuisier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursMinuisiersRepository->add($bricoleursMinuisier, true);

            return $this->redirectToRoute('app_minuisiers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('minuisiers_crud/new.html.twig', [
            'bricoleurs_minuisier' => $bricoleursMinuisier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_minuisiers_crud_show', methods: ['GET'])]
    public function show(BricoleursMinuisiers $bricoleursMinuisier): Response
    {
        return $this->render('minuisiers_crud/show.html.twig', [
            'bricoleurs_minuisier' => $bricoleursMinuisier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_minuisiers_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BricoleursMinuisiers $bricoleursMinuisier, BricoleursMinuisiersRepository $bricoleursMinuisiersRepository): Response
    {
        $form = $this->createForm(BricoleursMinuisiersType::class, $bricoleursMinuisier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursMinuisiersRepository->add($bricoleursMinuisier, true);

            return $this->redirectToRoute('app_minuisiers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('minuisiers_crud/edit.html.twig', [
            'bricoleurs_minuisier' => $bricoleursMinuisier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_minuisiers_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BricoleursMinuisiers $bricoleursMinuisier, BricoleursMinuisiersRepository $bricoleursMinuisiersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleursMinuisier->getId(), $request->request->get('_token'))) {
            $bricoleursMinuisiersRepository->remove($bricoleursMinuisier, true);
        }

        return $this->redirectToRoute('app_minuisiers_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
