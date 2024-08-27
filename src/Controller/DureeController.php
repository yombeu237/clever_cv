<?php

namespace App\Controller;

use App\Entity\Duree;
use App\Form\DureeType;
use App\Repository\DureeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/duree')]
class DureeController extends AbstractController
{
    #[Route('/', name: 'app_duree_index', methods: ['GET'])]
    public function index(DureeRepository $dureeRepository): Response
    {
        return $this->render('duree/index.html.twig', [
            'durees' => $dureeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_duree_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $duree = new Duree();
        $form = $this->createForm(DureeType::class, $duree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($duree);
            $entityManager->flush();

            return $this->redirectToRoute('app_duree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('duree/new.html.twig', [
            'duree' => $duree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_duree_show', methods: ['GET'])]
    public function show(Duree $duree): Response
    {
        return $this->render('duree/show.html.twig', [
            'duree' => $duree,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_duree_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Duree $duree, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DureeType::class, $duree);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_duree_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('duree/edit.html.twig', [
            'duree' => $duree,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_duree_delete', methods: ['POST'])]
    public function delete(Request $request, Duree $duree, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$duree->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($duree);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_duree_index', [], Response::HTTP_SEE_OTHER);
    }
}
