<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use ContainerM7CPF6T\getUser2Service;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use App\Repository\UserRepository;
use App\Entity\User;

#[Route('/profil')]

class ProfilController extends AbstractController
{
    #[Route('/index', name: 'app_profil')]
    public function index(): Response
    {
        if (!$this->getUser()){
            return $this->redirectToRoute('dashboard');
        }

        return $this->render('profil/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    public function Form(Request $request, UserRepository $UserRepository): Response
    {
        $User = new User();
        $form = $this->createForm(UsersType::class, $User);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $UserRepository->add($User, true);

            return $this->redirectToRoute('app_Users_crud_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('Users_crud/new.html.twig', [
            'User' => $User,
            'form' => $form,
        ]);
    }

    #[Route('/update/image', name: 'upload_image')]
    public function UpdateProfilImage(Request $request,FlashBagInterface $flashMessage)
    {
        $image = $request->files->get("image");
        $image_name = $image->getClientOriginalName();
        $image->move($this->getParameter("image_directory"), $image_name);
        $user = $this->getUser();
        $user->setImage($image_name);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
        $flashMessage->add("seccess", "Profil modifié !");
        return $this->redirectToRoute('app_profil');
    }

    // public function UpdateCoverImage(Request $request,FlashBagInterface $flashMessage)
    // {
    //     $image = $request->files->get("image");
    //     $image_name = $image->getClientOriginalName();
    //     $image->move($this->getParameter("image_directory"), $image_name);
    //     $user = $this->getUser();
    //     $user->setImage($image_name);
    //     $entityManager = $this->getDoctrine()->getManager();
    //     $entityManager->persist($user);
    //     $entityManager->flush();
    //     $flashMessage->add("seccess", "Coverture modifié !");
    //     return $this->redirectToRoute('app_profil');
    // }
}