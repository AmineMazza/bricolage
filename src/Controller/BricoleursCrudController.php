<?php

namespace App\Controller;

use App\Entity\Bricoleurs;
use App\Form\BricoleursType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BricoleursMinuisiersRepository;
use App\Repository\BricoleursPlatriersRepository;
use App\Repository\BricoleursRepository;
use App\Repository\BricoleursJardiniersRepository;
use App\Repository\BricoleursPlombiersRepository;
use App\Repository\BricoleursElectriciensRepository;
use App\Repository\BricoleursDemenageursRepository;




#[Route('/bricoleurs')]
class BricoleursCrudController extends AbstractController
{
    #[Route('/', name: 'app_bricoleurs_crud_index', methods: ['GET'])]
    public function index(BricoleursRepository $bricoleursRepository,
                          BricoleursMinuisiersRepository $bricoleursMinuisiersRepository,
                          BricoleursPlatriersRepository $bricoleursPlatriersRepository,
                          BricoleursJardiniersRepository $bricoleursJardiniersRepository,
                          BricoleursPlombiersRepository $bricoleursPlombiersRepository,
                          BricoleursElectriciensRepository $bricoleursElectriciensRepository,
                          BricoleursDemenageursRepository $bricoleursDemenageursRepository): Response
    {
        return $this->render('bricoleurs_crud/index.html.twig', [
            'bricoleurs' => $bricoleursRepository->findAll(),
            'bricoleurs_minuisiers' => $bricoleursMinuisiersRepository->findAll(),
            'bricoleurs_platriers' => $bricoleursPlatriersRepository->findAll(),
            'bricoleurs_jardiniers' => $bricoleursJardiniersRepository->findAll(),
            'bricoleurs_plombiers' => $bricoleursPlombiersRepository->findAll(),
            'bricoleurs_electriciens' => $bricoleursElectriciensRepository->findAll(),
            'bricoleurs_demenageurs' => $bricoleursDemenageursRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'app_bricoleurs_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursRepository $bricoleursRepository): Response
    {
        $bricoleur = new Bricoleurs();
        $form = $this->createForm(BricoleursType::class, $bricoleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursRepository->add($bricoleur, true);

            return $this->redirectToRoute('app_bricoleurs_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bricoleurs_crud/new.html.twig', [
            'bricoleur' => $bricoleur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bricoleurs_crud_show', methods: ['GET'])]
    public function show(Bricoleurs $bricoleur): Response
    {
        return $this->render('bricoleurs_crud/show.html.twig', [
            'bricoleur' => $bricoleur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_bricoleurs_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bricoleurs $bricoleur, BricoleursRepository $bricoleursRepository): Response
    {
        $form = $this->createForm(BricoleursType::class, $bricoleur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursRepository->add($bricoleur, true);

            return $this->redirectToRoute('app_bricoleurs_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bricoleurs_crud/edit.html.twig', [
            'bricoleur' => $bricoleur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_bricoleurs_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Bricoleurs $bricoleur, BricoleursRepository $bricoleursRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleur->getId(), $request->request->get('_token'))) {
            $bricoleursRepository->remove($bricoleur, true);
        }

        return $this->redirectToRoute('app_bricoleurs_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
