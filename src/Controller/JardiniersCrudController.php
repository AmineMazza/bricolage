<?php

namespace App\Controller;

use App\Entity\BricoleursJardiniers;
use App\Form\BricoleursJardiniersType;
use App\Repository\BricoleursJardiniersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/jardiniers')]
class JardiniersCrudController extends AbstractController
{
    #[Route('/index', name: 'app_jardiniers_crud_index', methods: ['GET'])]
    public function index(BricoleursJardiniersRepository $bricoleursJardiniersRepository): Response
    {
        return $this->render('jardiniers_crud/index.html.twig', [
            'bricoleurs_jardiniers' => $bricoleursJardiniersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_jardiniers_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, BricoleursJardiniersRepository $bricoleursJardiniersRepository): Response
    {
        $bricoleursJardinier = new BricoleursJardiniers();
        $form = $this->createForm(BricoleursJardiniersType::class, $bricoleursJardinier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursJardiniersRepository->add($bricoleursJardinier, true);

            return $this->redirectToRoute('app_jardiniers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jardiniers_crud/new.html.twig', [
            'bricoleurs_jardinier' => $bricoleursJardinier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jardiniers_crud_show', methods: ['GET'])]
    public function show(BricoleursJardiniers $bricoleursJardinier): Response
    {
        return $this->render('jardiniers_crud/show.html.twig', [
            'bricoleurs_jardinier' => $bricoleursJardinier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_jardiniers_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BricoleursJardiniers $bricoleursJardinier, BricoleursJardiniersRepository $bricoleursJardiniersRepository): Response
    {
        $form = $this->createForm(BricoleursJardiniersType::class, $bricoleursJardinier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bricoleursJardiniersRepository->add($bricoleursJardinier, true);

            return $this->redirectToRoute('app_jardiniers_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('jardiniers_crud/edit.html.twig', [
            'bricoleurs_jardinier' => $bricoleursJardinier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_jardiniers_crud_delete', methods: ['POST'])]
    public function delete(Request $request, BricoleursJardiniers $bricoleursJardinier, BricoleursJardiniersRepository $bricoleursJardiniersRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bricoleursJardinier->getId(), $request->request->get('_token'))) {
            $bricoleursJardiniersRepository->remove($bricoleursJardinier, true);
        }

        return $this->redirectToRoute('app_jardiniers_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
