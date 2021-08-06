<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DisciplineRepository;

class DisciplineController extends AbstractController
{
    /**
     * @Route("/discipline", name="discipline")
     */
    public function index(DisciplineRepository $repository): Response
    {
        $discipline = $repository->findAll();
        return $this->render('discipline/index.html.twig', [
            'controller_name' => 'DisciplineController',
            'discipline' => $discipline,
        ]);
    }
}
