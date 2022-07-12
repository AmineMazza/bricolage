<?php

namespace App\Controller;

use App\Entity\Command;
use App\Entity\Services;
use App\Form\CommandType;
use App\Repository\CommandRepository;
use App\Repository\SousServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/command')]
class CommandCrudController extends AbstractController
{
    #[Route('/', name: 'app_command_crud_index', methods: ['GET'])]
    public function index(CommandRepository $commandRepository): Response
    {
        return $this->render('command_crud/index.html.twig', [
            'commands' => $commandRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_command_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommandRepository $commandRepository): Response
    {
        $command = new Command();
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandRepository->add($command, true);

            return $this->redirectToRoute('app_command_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('command_crud/new.html.twig', [ 
                                // front_office\LandingPage.html.twig
            'command' => $command,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_command_crud_show', methods: ['GET'])]
    public function show(Command $command): Response
    {
        return $this->render('command_crud/show.html.twig', [
            'command' => $command,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_command_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Command $command, CommandRepository $commandRepository): Response
    {
        $form = $this->createForm(CommandType::class, $command);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandRepository->add($command, true);

            return $this->redirectToRoute('app_command_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('command_crud/edit.html.twig', [
            'command' => $command,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_command_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Command $command, CommandRepository $commandRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$command->getId(), $request->request->get('_token'))) {
            $commandRepository->remove($command, true);
        }

        return $this->redirectToRoute('app_command_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
