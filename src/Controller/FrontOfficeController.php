<?php

namespace App\Controller;

use App\Entity\Services;
use App\Repository\ServicesRepository;
use App\Repository\SousServicesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/')]

class FrontOfficeController extends AbstractController
{
    

    #[Route('/', name: 'app_front_office')]
    public function index(ServicesRepository $servicesRepository): Response
    {
        return $this->render('front_office/index.html.twig', [
            'controller_name' => 'FrontOfficeController',
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/FrontServices', name: 'app_front_office_services')]
    public function index2(ServicesRepository $servicesRepository): Response
    {
        return $this->render('front_office/services.html.twig', [
            'controller_name' => 'FrontOfficeController',
            'services' => $servicesRepository->findAll(),
        ]);
    }

    #[Route('/FrontAbout', name: 'app_front_office_about')]
    public function index3(): Response
    {
        return $this->render('front_office/about.html.twig', [
            'controller_name' => 'FrontOfficeController',

        ]);
    }

    #[Route('/FrontCatégories', name: 'app_front_office_catégories')]
    public function index4(): Response
    {
        return $this->render('front_office/catégories.html.twig', [
            'controller_name' => 'FrontOfficeController',
            // 'categories' => $CategorieRepository->findAll(),
        ]);
    }

    #[Route('/FrontThanks', name: 'app_front_office_thanks')]
    public function index5(): Response
    {
        return $this->render('front_office/thankspage.html.twig', [
            'controller_name' => 'FrontOfficeController',

        ]);
    }


    #[Route('/{id}', name: 'app_command_send', methods: ['GET'])]
    public function sendCommand(Services $service, SousServicesRepository $sousServicesRepository): Response
    {
        return $this->render('front_office/LandingPage.html.twig', [
            'service' => $service,
            'sous_services' => $sousServicesRepository->findAll(),
        ]);
    }       


    // #[Route('/connect', name: 'app_front_office_connect')]
    // public function connect(): Response
    // {
    //     return $this->render('Bricolage\templates\connect.php', [
    //         'controller_name' => 'FrontOfficeController',
    //         // 'categories' => $CategorieRepository->findAll(),
    //     ]);
    // }

}
