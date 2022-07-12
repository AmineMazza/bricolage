<?php

namespace App\Controller;

use App\Entity\SousServices;
use App\Form\SousServicesType;
use App\Repository\SousServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/sous/services')]
class SousServicesCrudController extends AbstractController
{
    #[Route('/', name: 'app_sous_services_crud_index', methods: ['GET'])]
    public function index(SousServicesRepository $sousServicesRepository): Response
    {
        return $this->render('sous_services_crud/index.html.twig', [
            'sous_services' => $sousServicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sous_services_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SousServicesRepository $sousServicesRepository, SluggerInterface $slugger): Response
    {
        $sousService = new SousServices();
        $form = $this->createForm(SousServicesType::class, $sousService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             /** @var UploadedFile $brochureFile */
             $brochureFile = $form->get('image')->getData();

             // this condition is needed because the 'brochure' field is not required
             // so the PDF file must be processed only when a file is uploaded
             if ($brochureFile) {
                 $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                 // this is needed to safely include the file name as part of the URL
                 $safeFilename = $slugger->slug($originalFilename);
                 $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
 
                 // Move the file to the directory where brochures are stored
                 try {
                     $brochureFile->move(
                         $this->getParameter('brochures_directory'),
                         $newFilename
                     );
                 } catch (FileException $e) {
                     // ... handle exception if something happens during file upload
                 }
 
                 // updates the 'brochureFilename' property to store the PDF file name
                 // instead of its contents
                 $sousService->setImage($newFilename);
             }
            $sousServicesRepository->add($sousService, true);
            return $this->redirectToRoute('app_sous_services_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_services_crud/new.html.twig', [
            'sous_service' => $sousService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sous_services_crud_show', methods: ['GET'])]
    public function show(SousServices $sousService): Response
    {
        return $this->render('sous_services_crud/show.html.twig', [
            'sous_service' => $sousService,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sous_services_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SousServices $sousService, SousServicesRepository $sousServicesRepository,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(SousServicesType::class, $sousService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

             /** @var UploadedFile $brochureFile */
             $brochureFile = $form->get('image')->getData();

             // this condition is needed because the 'brochure' field is not required
             // so the PDF file must be processed only when a file is uploaded
             if ($brochureFile) {
                 $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                 // this is needed to safely include the file name as part of the URL
                 $safeFilename = $slugger->slug($originalFilename);
                 $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();
 
                 // Move the file to the directory where brochures are stored
                 try {
                     $brochureFile->move(
                         $this->getParameter('brochures_directory'),
                         $newFilename
                     );
                 } catch (FileException $e) {
                     // ... handle exception if something happens during file upload
                 }
 
                 // updates the 'brochureFilename' property to store the PDF file name
                 // instead of its contents
                 $sousService->setImage($newFilename);
             }
            $sousServicesRepository->add($sousService, true);
            return $this->redirectToRoute('app_sous_services_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sous_services_crud/edit.html.twig', [
            'sous_service' => $sousService,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sous_services_crud_delete', methods: ['POST'])]
    public function delete(Request $request, SousServices $sousService, SousServicesRepository $sousServicesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousService->getId(), $request->request->get('_token'))) {
            $sousServicesRepository->remove($sousService, true);
        }

        return $this->redirectToRoute('app_sous_services_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
