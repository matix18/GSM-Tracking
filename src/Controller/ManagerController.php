<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends AbstractController
{
    /**
     * @Route("/manager", name="manager")
     */
    public function index()
    {
        return $this->render('manager/index.html.twig', [
            'controller_name' => 'ManagerController',
        ]);
    }
    
    /**
     * @Route("/manager/menuvol", name="menuvol")
     */
    public function menuvol()
    {
        return $this->render('manager/menuvol.html.twig', [
            'controller_name' => 'ManagerController',
        ]);
    }
    
        /**
         * @Route("/manager/menuvoyage", name="menuvoyage")
         */
        public function menuvoyage()
        {
            return $this->render('manager/menuvoyage.html.twig', [
                'controller_name' => 'ManagerController',
            ]);
    }
}
