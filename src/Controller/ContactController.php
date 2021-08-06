<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $contact = new Contact(); //permet de créer un nouveau formulaire vide
        $form = $this -> createForm(ContactType::class,$contact); //crétation du formulaire d'après le type
        $form -> handleRequest($request); //le formulaire va faire correspondre les posts de la requête avec les champs de l'entity

        if ($form->isSubmitted() && $form->isValid()) { //lors de la soumission s'il est valide
            $contact = $form->getData(); // on crée un nouvel objet à partir des données du formulaire

            $email = (new Email()) //création d'un nouveau email
            ->from("body.nice@coachngo.com")
            ->to("body.nice@coachngo.com")
            ->subject("Information")
            ->html(
                "<h1>Nouveau contact</h1>".
                "<p>".$contact->getNom()."</p>"."<p>".$contact->getEmail()."</p>"."<p>".$contact->getMessage()."</p>");
            $mailer->send($email); //envoi de l'email

            
            return $this->redirectToRoute('accueil'); //rediriger vers l'accueil
        }
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'ContactController', 'form'=>$form->createView()
        ]);
    }

}
