<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HtmxController extends AbstractController
{
    #[Route('/htmx', name: 'app_htmx')]
    public function htmx(): Response
    {
        return $this->render('htmx/htmx.html.twig', [
            'controller_name' => 'HtmxController',
        ]);
    }

    #[Route('/htmx_list_users', name: 'app_htmx_list_users')]
    public function htmx_list_users(UserRepository $userRepository): Response
    {
        return $this->render('htmx/htmx_list_users.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/htmx_click_to_edit', name: 'app_htmx_click_to_edit')]
    public function htmx_click_to_edit(Request $request, EntityManagerInterface $em): Response
    {

        $user = new User;

        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('app_htmx')
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();

            return $this->render('htmx/htmx.html.twig');
        }

        return $this->render('htmx/htmx_click_to_edit.html.twig', [
            'form' => $form->createView( ),
        ]);
    }
}
