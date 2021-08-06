<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Form\AvisType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class AvisController extends AbstractController
{
    /**
     * @Route("/avis", name="avis")
     */
    public function index(Request $request, EntityManagerInterface $entityManager)
    {
        $avis = new Avis(); //permet de créer un nouveau formulaire vide
        $form = $this -> createForm(AvisType::class,$avis); //crétation du formulaire d'après le type
        $form -> handleRequest($request); //le formulaire va faire correspondre les posts de la requête avec les champs de l'entity

        if ($form->isSubmitted() && $form->isValid()) { //lors de la soumission s'il est valide
            $avis = $form->getData(); // on crée un nouvel objet à partir des données du formulaire
            $entityManager->persist($avis);
            $entityManager->flush();
            
            return $this->redirectToRoute('accueil'); //rediriger vers l'accueil
        }
        return $this->render('avis/index.html.twig', [
            'controller_name' => 'AvisController', 'form'=>$form->createView()
        ]);
    }

}
