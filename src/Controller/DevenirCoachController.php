<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DevenirCoachController extends AbstractController
{
    /**
     * @Route("/devenirCoach", name="devenir_coach")
     */
    public function index(): Response
    {
        return $this->render('devenir_coach/index.html.twig', [
            'controller_name' => 'DevenirCoachController',
        ]);
    }
}
