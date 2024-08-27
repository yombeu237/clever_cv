<?php

namespace App\Controller;

use App\Entity\Connaissance;
use App\Form\ConnaissanceType;
use App\Repository\ConnaissanceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/connaissance')]
class ConnaissanceController extends AbstractController
{
    #[Route('/', name: 'app_connaissance_index', methods: ['GET'])]
    public function index(ConnaissanceRepository $connaissanceRepository): Response
    {
        return $this->render('connaissance/index.html.twig', [
            'connaissances' => $connaissanceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_connaissance_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $connaissance = new Connaissance();
        $form = $this->createForm(ConnaissanceType::class, $connaissance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($connaissance);
            $entityManager->flush();

            return $this->redirectToRoute('app_connaissance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connaissance/new.html.twig', [
            'connaissance' => $connaissance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_connaissance_show', methods: ['GET'])]
    public function show(Connaissance $connaissance): Response
    {
        return $this->render('connaissance/show.html.twig', [
            'connaissance' => $connaissance,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_connaissance_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Connaissance $connaissance, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConnaissanceType::class, $connaissance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_connaissance_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('connaissance/edit.html.twig', [
            'connaissance' => $connaissance,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_connaissance_delete', methods: ['POST'])]
    public function delete(Request $request, Connaissance $connaissance, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$connaissance->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($connaissance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_connaissance_index', [], Response::HTTP_SEE_OTHER);
    }
}
