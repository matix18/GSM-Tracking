<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Bagages;
use App\Form\BagagesType;
use App\Repository\BagagesRepository;

use App\Entity\Voyages;
use App\Form\VoyagesType;
use App\Repository\VoyagesRepository;

class SearchController extends AbstractController
{
    /**
     * @Route("/search", name="search")
     */
    public function index(Request $request): Response
    {
        $repo = $this->getDoctrine()->getManager();
        $code = $request->query->get('code');
        $BagageRepository = $repo->getRepository(Bagages::class)->findByCodeBagage($code);

        // $id = $repo->getRepository(Voyages::class)->findOneBy($BagageRepository->getId());
        // $VoyageRepository = $repo->getRepository(Voyages::class)->findByClient($id);
        // dd($id);

        return $this->render('search/index.html.twig', [
            'code' => $code,
            'BagageRepository' => $BagageRepository,
            // 'VoyageRepository' => $VoyageRepository,
        ]);
    }
}
