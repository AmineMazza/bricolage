<?php

namespace App\Controller;

use App\Entity\BricoleursPlatriers;
use App\Form\BricoleursPlatriersType;
use App\Repository\BricoleursPlatriersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/platriers')]
class PlatriersCrudController extends AbstractController
{
    #[Route('/index', name: 'app_platriers_crud_index', methods: ['GET'])]
    public function index(BricoleursPlatriersRepository $bricoleursPlatriersRepository): Response
    {
        return $this->render('platriers_crud/index.html.twig', [
            'bricoleurs_platriers' => $bricoleursPlatriersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_platriers_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursPlatriersRepository $bricoleursPlatriersRepository): Response
    {
        $bricoleursPlatrier = new BricoleursPlatriers();
        $form = $this->createForm(BricoleursPlatriersType::class, $bricoleursPlatrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursPlatriersRepository->add($bricoleursPlatrier, true);

            return $this->redirectToRoute('app_platriers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('platriers_crud/new.html.twig', [
            'bricoleurs_platrier' => $bricoleursPlatrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_platriers_crud_show', methods: ['GET'])]
    public function show(BricoleursPlatriers $bricoleursPlatrier): Response
    {
        return $this->render('platriers_crud/show.html.twig', [
            'bricoleurs_platrier' => $bricoleursPlatrier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_platriers_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BricoleursPlatriers $bricoleursPlatrier, BricoleursPlatriersRepository $bricoleursPlatriersRepository): Response
    {
        $form = $this->createForm(BricoleursPlatriersType::class, $bricoleursPlatrier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursPlatriersRepository->add($bricoleursPlatrier, true);

            return $this->redirectToRoute('app_platriers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('platriers_crud/edit.html.twig', [
            'bricoleurs_platrier' => $bricoleursPlatrier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_platriers_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BricoleursPlatriers $bricoleursPlatrier, BricoleursPlatriersRepository $bricoleursPlatriersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleursPlatrier->getId(), $request->request->get('_token'))) {
            $bricoleursPlatriersRepository->remove($bricoleursPlatrier, true);
        }

        return $this->redirectToRoute('app_platriers_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
