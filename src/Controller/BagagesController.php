<?php

namespace App\Controller;

use App\Entity\Bagages;
use App\Form\BagagesType;
use App\Repository\BagagesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/bagages")
 */
class BagagesController extends AbstractController
{
    /**
     * @Route("/", name="bagages_index", methods={"GET"})
     */
    public function index(BagagesRepository $bagagesRepository): Response
    {
        return $this->render('bagages/index.html.twig', [
            'bagages' => $bagagesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="bagages_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $bagage = new Bagages();
        $form = $this->createForm(BagagesType::class, $bagage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($bagage);
            $entityManager->flush();

            // return $this->redirectToRoute('bagages_index');
            return $this->render('bagages/new.html.twig', [
                'editMode' => $bagage->getCodeBagage(),
                'adresse' => $bagage->getReservation()->getClient()->getEmailcli(),
                'form' => $form->createView(),
            ]);
        }

        return $this->render('bagages/new.html.twig', [
            'editMode' => '',
            'adresse' => '',
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bagages_show", methods={"GET"})
     */
    public function show(Bagages $bagage): Response
    {
        return $this->render('bagages/show.html.twig', [
            'bagage' => $bagage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="bagages_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Bagages $bagage): Response
    {
        $form = $this->createForm(BagagesType::class, $bagage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('bagages_index');
        }

        return $this->render('bagages/edit.html.twig', [
            'bagage' => $bagage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="bagages_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Bagages $bagage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bagage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bagage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bagages_index');
    }
}
