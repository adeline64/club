<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PartenariatController extends AbstractController
{
    /**
     * @Route("/partenariat", name="partenariat")
     */
    public function index(): Response
    {
        return $this->render('partenariat/index.html.twig', [
            'controller_name' => 'PartenariatController',
        ]);
    }
}
