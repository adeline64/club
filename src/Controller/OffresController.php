<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvisRepository;

class OffresController extends AbstractController
{
    /**
     * @Route("/offres", name="offres")
     */
    public function index(AvisRepository $repository): Response
    {
        $avis = $repository->findAll();

        return $this->render('offres/index.html.twig', [
            'controller_name' => 'OffresController',
            'avis' => $avis
        ]);
    }
}
