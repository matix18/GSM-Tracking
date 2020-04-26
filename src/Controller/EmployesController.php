<?php

namespace App\Controller;

use App\Entity\Employes;
use App\Form\EmployesType;
use App\Repository\EmployesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/employes")
 */
class EmployesController extends AbstractController
{
    /**
     * @Route("/", name="employes_index", methods={"GET"})
     */
    public function index(EmployesRepository $employesRepository): Response
    {
        return $this->render('employes/index.html.twig', [
            'employes' => $employesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="employes_new", methods={"GET","POST"})
     */
    public function new(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $employe = new Employes();
        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $hash = $encoder->encodePassword($employe, $employe->getPassword());
            $employe->setPassword($hash);

            $role = [];
            $role = $request->get('roles');
            $employe->setRoles(['roles' => $role]);

            $entityManager->persist($employe);
            $entityManager->flush();

            return $this->redirectToRoute('employes_index');
        }

        return $this->render('employes/new.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employes_show", methods={"GET"})
     */
    public function show(Employes $employe): Response
    {
        return $this->render('employes/show.html.twig', [
            'employe' => $employe,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="employes_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Employes $employe, UserPasswordEncoderInterface $encoder): Response
    {
        $form = $this->createForm(EmployesType::class, $employe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $this->getDoctrine()->getManager();

            $hash = $encoder->encodePassword($employe, $employe->getPassword());
            $employe->setPassword($hash);

            $role = [];
            $role = $request->get('roles');
            $employe->setRoles(['roles' => $role]);
            
            $manager->persist($employe);
            $manager->flush();

            return $this->redirectToRoute('employes_index');
        }

        return $this->render('employes/edit.html.twig', [
            'employe' => $employe,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="employes_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Employes $employe): Response
    {
        if ($this->isCsrfTokenValid('delete'.$employe->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($employe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('employes_index');
    }
}
