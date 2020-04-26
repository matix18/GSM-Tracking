<?php

namespace App\Controller;

use App\Entity\Vols;
use App\Form\VolsType;
use App\Repository\VolsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/vols")
 */
class VolsController extends AbstractController
{
    /**
     * @Route("/", name="vols_index", methods={"GET"})
     */
    public function index(VolsRepository $volsRepository): Response
    {
        return $this->render('vols/index.html.twig', [
            'vols' => $volsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="vols_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $vol = new Vols();
        $form = $this->createForm(VolsType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($vol);
            $entityManager->flush();

            // return $this->redirectToRoute('vols_new', ['success' => $vol->getId(), 'form' => $form->createView()]);
            return $this->render('vols/new.html.twig', [
                'editMode' => $vol->getId(),
                'form' => $form->createView(),]);
        }

        return $this->render('vols/new.html.twig', [
            'editMode' => $vol->getId(),
            'vol' => $vol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vols_show", methods={"GET"})
     */
    public function show(Vols $vol): Response
    {
        return $this->render('vols/show.html.twig', [
            'vol' => $vol,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="vols_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Vols $vol): Response
    {
        $form = $this->createForm(VolsType::class, $vol);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vols_index');
        }

        return $this->render('vols/edit.html.twig', [
            'vol' => $vol,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="vols_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Vols $vol): Response
    {
        if ($this->isCsrfTokenValid('delete'.$vol->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($vol);
            $entityManager->flush();
        }

        return $this->redirectToRoute('vols_index');
    }
}
