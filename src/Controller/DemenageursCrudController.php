<?php

namespace App\Controller;

use App\Entity\BricoleursDemenageurs;
use App\Form\BricoleursDemenageursType;
use App\Repository\BricoleursDemenageursRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/demenageurs')]
class DemenageursCrudController extends AbstractController
{
    #[Route('/index', name: 'app_demenageurs_crud_index', methods: ['GET'])]
    public function index(BricoleursDemenageursRepository $bricoleursDemenageursRepository): Response
    {
        return $this->render('demenageurs_crud/index.html.twig', [
            'bricoleurs_demenageurs' => $bricoleursDemenageursRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demenageurs_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursDemenageursRepository $bricoleursDemenageursRepository): Response
    {
        $bricoleursDemenageur = new BricoleursDemenageurs();
        $form = $this->createForm(BricoleursDemenageursType::class, $bricoleursDemenageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursDemenageursRepository->add($bricoleursDemenageur, true);

            return $this->redirectToRoute('app_demenageurs_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demenageurs_crud/new.html.twig', [
            'bricoleurs_demenageur' => $bricoleursDemenageur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demenageurs_crud_show', methods: ['GET'])]
    public function show(BricoleursDemenageurs $bricoleursDemenageur): Response
    {
        return $this->render('demenageurs_crud/show.html.twig', [
            'bricoleurs_demenageur' => $bricoleursDemenageur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_demenageurs_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BricoleursDemenageurs $bricoleursDemenageur, BricoleursDemenageursRepository $bricoleursDemenageursRepository): Response
    {
        $form = $this->createForm(BricoleursDemenageursType::class, $bricoleursDemenageur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursDemenageursRepository->add($bricoleursDemenageur, true);

            return $this->redirectToRoute('app_demenageurs_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('demenageurs_crud/edit.html.twig', [
            'bricoleurs_demenageur' => $bricoleursDemenageur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demenageurs_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BricoleursDemenageurs $bricoleursDemenageur, BricoleursDemenageursRepository $bricoleursDemenageursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleursDemenageur->getId(), $request->request->get('_token'))) {
            $bricoleursDemenageursRepository->remove($bricoleursDemenageur, true);
        }

        return $this->redirectToRoute('app_demenageurs_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
