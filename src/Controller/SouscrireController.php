<?php

namespace App\Controller;

use App\Entity\Souscrire;
use App\Form\SouscrireType;
use App\Repository\SouscrireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/souscrire')]
class SouscrireController extends AbstractController
{
    #[Route('/', name: 'app_souscrire_index', methods: ['GET'])]
    public function index(SouscrireRepository $souscrireRepository): Response
    {
        return $this->render('souscrire/index.html.twig', [
            'souscrires' => $souscrireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_souscrire_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $souscrire = new Souscrire();
        $form = $this->createForm(SouscrireType::class, $souscrire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($souscrire);
            $entityManager->flush();

            return $this->redirectToRoute('app_souscrire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souscrire/new.html.twig', [
            'souscrire' => $souscrire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_souscrire_show', methods: ['GET'])]
    public function show(Souscrire $souscrire): Response
    {
        return $this->render('souscrire/show.html.twig', [
            'souscrire' => $souscrire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_souscrire_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Souscrire $souscrire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SouscrireType::class, $souscrire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_souscrire_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('souscrire/edit.html.twig', [
            'souscrire' => $souscrire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_souscrire_delete', methods: ['POST'])]
    public function delete(Request $request, Souscrire $souscrire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$souscrire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($souscrire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_souscrire_index', [], Response::HTTP_SEE_OTHER);
    }
}
