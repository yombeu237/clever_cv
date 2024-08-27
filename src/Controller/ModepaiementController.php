<?php

namespace App\Controller;

use App\Entity\ModeDePaiement;
use App\Form\ModeDePaiementType;
use App\Repository\ModeDePaiementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/modepaiement')]
class ModepaiementController extends AbstractController
{
    #[Route('/', name: 'app_modepaiement_index', methods: ['GET'])]
    public function index(ModeDePaiementRepository $modeDePaiementRepository): Response
    {
        return $this->render('modepaiement/index.html.twig', [
            'mode_de_paiements' => $modeDePaiementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_modepaiement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $modeDePaiement = new ModeDePaiement();
        $form = $this->createForm(ModeDePaiementType::class, $modeDePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($modeDePaiement);
            $entityManager->flush();

            return $this->redirectToRoute('app_modepaiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modepaiement/new.html.twig', [
            'mode_de_paiement' => $modeDePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modepaiement_show', methods: ['GET'])]
    public function show(ModeDePaiement $modeDePaiement): Response
    {
        return $this->render('modepaiement/show.html.twig', [
            'mode_de_paiement' => $modeDePaiement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_modepaiement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ModeDePaiement $modeDePaiement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ModeDePaiementType::class, $modeDePaiement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_modepaiement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('modepaiement/edit.html.twig', [
            'mode_de_paiement' => $modeDePaiement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_modepaiement_delete', methods: ['POST'])]
    public function delete(Request $request, ModeDePaiement $modeDePaiement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$modeDePaiement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($modeDePaiement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_modepaiement_index', [], Response::HTTP_SEE_OTHER);
    }
}
