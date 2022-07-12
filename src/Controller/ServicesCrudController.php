<?php

namespace App\Controller;

use App\Entity\Services;
use App\Form\ServicesType;
use App\Repository\ServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;


#[Route('/services')]
class ServicesCrudController extends AbstractController
{
    #[Route('/index', name: 'app_services_crud_index', methods: ['GET'])]
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('services_crud/index.html.twig', [
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_services_crud_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ServicesRepository $servicesRepository, SluggerInterface $slugger): Response
    {
        $service = new Services();
        $form = $this->createForm(ServicesType::class, $service);
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
                 $service->setImage($newFilename);
             }

            $servicesRepository->add($service, true);
            return $this->redirectToRoute('app_services_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('services_crud/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
        
    }

    #[Route('/{id}', name: 'app_services_crud_show', methods: ['GET'])]
    public function show(Services $service): Response
    {
        return $this->render('services_crud/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_services_crud_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Services $service, ServicesRepository $servicesRepository,SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ServicesType::class, $service);
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
                $service->setImage($newFilename);
            }
            $servicesRepository->add($service, true);
            return $this->redirectToRoute('app_services_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('services_crud/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_services_crud_delete', methods: ['POST'])]
    public function delete(Request $request, Services $service, ServicesRepository $servicesRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$service->getId(), $request->request->get('_token'))) {
            $servicesRepository->remove($service, true);
        }

        return $this->redirectToRoute('app_services_crud_index', [], Response::HTTP_SEE_OTHER);
    }
}
