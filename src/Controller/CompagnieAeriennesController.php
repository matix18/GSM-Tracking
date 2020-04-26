<?php

namespace App\Controller;

use App\Entity\CompagnieAeriennes;
use App\Form\CompagnieAeriennesType;
use App\Repository\CompagnieAeriennesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/compagnie/aeriennes")
 */
class CompagnieAeriennesController extends AbstractController
{
    /**
     * @Route("/", name="compagnie_aeriennes_index", methods={"GET"})
     */
    public function index(CompagnieAeriennesRepository $compagnieAeriennesRepository): Response
    {
        return $this->render('compagnie_aeriennes/index.html.twig', [
            'compagnie_aeriennes' => $compagnieAeriennesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="compagnie_aeriennes_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $compagnieAerienne = new CompagnieAeriennes();
        $form = $this->createForm(CompagnieAeriennesType::class, $compagnieAerienne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($compagnieAerienne);
            $entityManager->flush();

            return $this->render('compagnie_aeriennes/new.html.twig', [
                'editMode' => $compagnieAerienne->getNomCompagnie(),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('compagnie_aeriennes/new.html.twig', [
            'editMode' => '',
            'compagnie_aerienne' => $compagnieAerienne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compagnie_aeriennes_show", methods={"GET"})
     */
    public function show(CompagnieAeriennes $compagnieAerienne): Response
    {
        return $this->render('compagnie_aeriennes/show.html.twig', [
            'compagnie_aerienne' => $compagnieAerienne,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="compagnie_aeriennes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, CompagnieAeriennes $compagnieAerienne): Response
    {
        $form = $this->createForm(CompagnieAeriennesType::class, $compagnieAerienne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compagnie_aeriennes_index');
        }

        return $this->render('compagnie_aeriennes/edit.html.twig', [
            'compagnie_aerienne' => $compagnieAerienne,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="compagnie_aeriennes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, CompagnieAeriennes $compagnieAerienne): Response
    {
        if ($this->isCsrfTokenValid('delete'.$compagnieAerienne->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($compagnieAerienne);
            $entityManager->flush();
        }

        return $this->redirectToRoute('compagnie_aeriennes_index');
    }
}
