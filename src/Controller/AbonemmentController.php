<?php

namespace App\Controller;

use App\Entity\Abonemment;
use App\Form\Abonemment1Type;
use App\Repository\AbonemmentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/abonemment')]
class AbonemmentController extends AbstractController
{
    #[Route('/', name: 'app_abonemment_index', methods: ['GET'])]
    public function index(AbonemmentRepository $abonemmentRepository): Response
    {
        return $this->render('abonemment/index.html.twig', [
            'abonemments' => $abonemmentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_abonemment_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $abonemment = new Abonemment();
        $form = $this->createForm(Abonemment1Type::class, $abonemment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($abonemment);
            $entityManager->flush();

            return $this->redirectToRoute('app_abonemment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonemment/new.html.twig', [
            'abonemment' => $abonemment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_abonemment_show', methods: ['GET'])]
    public function show(Abonemment $abonemment): Response
    {
        return $this->render('abonemment/show.html.twig', [
            'abonemment' => $abonemment,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_abonemment_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Abonemment $abonemment, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Abonemment1Type::class, $abonemment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_abonemment_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('abonemment/edit.html.twig', [
            'abonemment' => $abonemment,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_abonemment_delete', methods: ['POST'])]
    public function delete(Request $request, Abonemment $abonemment, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$abonemment->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($abonemment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_abonemment_index', [], Response::HTTP_SEE_OTHER);
    }
}
