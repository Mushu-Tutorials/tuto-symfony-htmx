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

    #[Route('/htmx_user_show/{id}', name: 'htmx_user_show')]
    public function htmx_user_show(User $user): Response
    {
        return $this->render('htmx/htmx_show_user.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/htmx_user_edit/{id}', name: 'htmx_user_edit')]
    public function htmx_user_edit(User $user, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UserType::class, $user, [
            'action' => $this->generateUrl('htmx_user_show', ['id' => $user->getId()]),
            'attr' => [
                // 'hx-post' => $this->generateUrl('htmx_user_edit', ['id' => $user->getId()]),
                // 'hx-target' => '#htmx-user-edit',
                // 'hx-swap' => 'outerHTML',
                'class' => 'mx-auto mt-8 mb-0 max-w-md space-y-4'
            ]
        ]);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            // dd($user);
            $em->persist($user);
            $em->flush();

            // return $this->render('htmx/htmx.html.twig');
        }

        return $this->render('htmx/htmx_click_to_edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }
}
