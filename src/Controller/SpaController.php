<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SpaController extends AbstractController
{
    #[Route('/', name: 'app_spa')]
    public function index(): Response
    {
        return $this->render('spa/index.html.twig', [
            'controller_name' => 'SpaController',
        ]);
    }

    #[Route('/features', name: 'app_spa_features')]
    public function features(): Response
    {
        return $this->render('spa/features.html.twig', [
            'controller_name' => 'SpaController',
        ]);
    }

    #[Route('/contact', name: 'app_spa_contact')]
    public function contct(Request $request, EntityManagerInterface $em): Response
    {
        $contact = new Contact;

        $form = $this->createForm(ContactType::class, $contact, [
            'action' => $this->generateUrl('app_spa_contact')
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($contact);
            $em->flush();

            return $this->render('spa/contct_success.html.twig');
        }

        return $this->render('spa/contct.html.twig', [
            'form' => $form->createView( ),
        ]);
    }
}
