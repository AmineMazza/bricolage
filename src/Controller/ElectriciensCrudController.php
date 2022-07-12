<?php

namespace App\Controller;

use App\Entity\BricoleursElectriciens;
use App\Form\BricoleursElectriciensType;
use App\Repository\BricoleursElectriciensRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/electriciens')]
class ElectriciensCrudController extends AbstractController
{
    #[Route('/index', name: 'app_electriciens_crud_index', methods: ['GET'])]
    public function index(BricoleursElectriciensRepository $bricoleursElectriciensRepository): Response
    {
        return $this->render('electriciens_crud/index.html.twig', [
            'bricoleurs_electriciens' => $bricoleursElectriciensRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_electriciens_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursElectriciensRepository $bricoleursElectriciensRepository): Response
    {
        $bricoleursElectricien = new BricoleursElectriciens();
        $form = $this->createForm(BricoleursElectriciensType::class, $bricoleursElectricien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursElectriciensRepository->add($bricoleursElectricien, true);

            return $this->redirectToRoute('app_electriciens_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('electriciens_crud/new.html.twig', [
            'bricoleurs_electricien' => $bricoleursElectricien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_electriciens_crud_show', methods: ['GET'])]
    public function show(BricoleursElectriciens $bricoleursElectricien): Response
    {
        return $this->render('electriciens_crud/show.html.twig', [
            'bricoleurs_electricien' => $bricoleursElectricien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_electriciens_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BricoleursElectriciens $bricoleursElectricien, BricoleursElectriciensRepository $bricoleursElectriciensRepository): Response
    {
        $form = $this->createForm(BricoleursElectriciensType::class, $bricoleursElectricien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursElectriciensRepository->add($bricoleursElectricien, true);

            return $this->redirectToRoute('app_electriciens_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('electriciens_crud/edit.html.twig', [
            'bricoleurs_electricien' => $bricoleursElectricien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_electriciens_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BricoleursElectriciens $bricoleursElectricien, BricoleursElectriciensRepository $bricoleursElectriciensRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleursElectricien->getId(), $request->request->get('_token'))) {
            $bricoleursElectriciensRepository->remove($bricoleursElectricien, true);
        }

        return $this->redirectToRoute('app_electriciens_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
