<?php

namespace App\Controller;

use App\Entity\BricoleursPlombiers;
use App\Form\BricoleursPlombiersType;
use App\Repository\BricoleursPlombiersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plombiers')]
class PlombiersCrudController extends AbstractController
{
    #[Route('/index', name: 'app_plombiers_crud_index', methods: ['GET'])]
    public function index(BricoleursPlombiersRepository $bricoleursPlombiersRepository): Response
    {
        return $this->render('plombiers_crud/index.html.twig', [
            'bricoleurs_plombiers' => $bricoleursPlombiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_plombiers_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursPlombiersRepository $bricoleursPlombiersRepository): Response
    {
        $bricoleursPlombier = new BricoleursPlombiers();
        $form = $this->createForm(BricoleursPlombiersType::class, $bricoleursPlombier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursPlombiersRepository->add($bricoleursPlombier, true);

            return $this->redirectToRoute('app_plombiers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plombiers_crud/new.html.twig', [
            'bricoleurs_plombier' => $bricoleursPlombier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plombiers_crud_show', methods: ['GET'])]
    public function show(BricoleursPlombiers $bricoleursPlombier): Response
    {
        return $this->render('plombiers_crud/show.html.twig', [
            'bricoleurs_plombier' => $bricoleursPlombier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_plombiers_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BricoleursPlombiers $bricoleursPlombier, BricoleursPlombiersRepository $bricoleursPlombiersRepository): Response
    {
        $form = $this->createForm(BricoleursPlombiersType::class, $bricoleursPlombier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursPlombiersRepository->add($bricoleursPlombier, true);

            return $this->redirectToRoute('app_plombiers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('plombiers_crud/edit.html.twig', [
            'bricoleurs_plombier' => $bricoleursPlombier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_plombiers_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BricoleursPlombiers $bricoleursPlombier, BricoleursPlombiersRepository $bricoleursPlombiersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleursPlombier->getId(), $request->request->get('_token'))) {
            $bricoleursPlombiersRepository->remove($bricoleursPlombier, true);
        }

        return $this->redirectToRoute('app_plombiers_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
