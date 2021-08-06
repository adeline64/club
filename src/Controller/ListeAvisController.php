<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvisRepository;


class ListeAvisController extends AbstractController
{
    /**
     * @Route("/listeAvis", name="liste_avis")
     */
    public function index(AvisRepository $repository): Response
    {
        $avis = $repository->findAll();
        return $this->render('liste_avis/index.html.twig', [
            'controller_name' => 'ListeAvisController',
            'avis' => $avis,
        ]);
    }
}
