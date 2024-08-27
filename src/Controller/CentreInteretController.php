<?php

namespace App\Controller;

use App\Entity\CentreInteret;
use App\Form\CentreInteretType;
use App\Repository\CentreInteretRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/centre/interet')]
class CentreInteretController extends AbstractController
{
    #[Route('/', name: 'app_centre_interet_index', methods: ['GET'])]
    public function index(CentreInteretRepository $centreInteretRepository): Response
    {
        return $this->render('centre_interet/index.html.twig', [
            'centre_interets' => $centreInteretRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_centre_interet_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $centreInteret = new CentreInteret();
        $form = $this->createForm(CentreInteretType::class, $centreInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($centreInteret);
            $entityManager->flush();

            return $this->redirectToRoute('app_centre_interet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centre_interet/new.html.twig', [
            'centre_interet' => $centreInteret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centre_interet_show', methods: ['GET'])]
    public function show(CentreInteret $centreInteret): Response
    {
        return $this->render('centre_interet/show.html.twig', [
            'centre_interet' => $centreInteret,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_centre_interet_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CentreInteret $centreInteret, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CentreInteretType::class, $centreInteret);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_centre_interet_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('centre_interet/edit.html.twig', [
            'centre_interet' => $centreInteret,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_centre_interet_delete', methods: ['POST'])]
    public function delete(Request $request, CentreInteret $centreInteret, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$centreInteret->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($centreInteret);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_centre_interet_index', [], Response::HTTP_SEE_OTHER);
    }
}
