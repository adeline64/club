<?php

namespace App\Controller;

use App\Entity\Discipline;
use App\Entity\Coach;
use App\Form\DisciplineType;
use App\Repository\DisciplineRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;



/**
 * @Route("/discipline/coach")
 */
class DisciplineCoachController extends AbstractController
{
    /**
     * @Route("/", name="discipline_coach_index", methods={"GET","POST"})
     */
    public function index(DisciplineRepository $disciplineRepository, Request $request): Response
    {
        $discipline = new Discipline();
        $formDiscipline = $this->createForm(DisciplineType::class, $discipline, [
            'action' => $this->generateUrl('discipline_coach_index'),
        ]);


        //  $formDiscipline = $this->createFormBuilder()
        // ->add('discipline', ChoiceType::class,
        // [
        //     'attr' => ['class' =>'form-control form-control-lg form-control-borderless'],
        //     'label' => '',
        //     'choices' => $this->getDoctrine()->getRepository(Discipline::class)->findAll(),
        //     'choice_value' => 'id',
        //     'choice_label' => function(?Discipline $discipline) {
        //         return $discipline ? strtoupper($discipline->getNom()) : '';
        //     }
        // ])
        // ->add('submit', SubmitType::class, [
        //     'label' => 'Chercher',
        //     'attr' => ['class' =>'btn btn-lg btn-recherche'],
        // ])
        // ->getForm();

        $formDiscipline->handleRequest($request);
        
        if ($formDiscipline->isSubmitted() && $formDiscipline->isValid()) {
            //cherchez les coachs d'une discipline sélectionnée
            $discipline = $formDiscipline->getData();
            // dd($discipline);

        }
        // if($formDiscipline->isSubmitted()){
        //     dd($formDiscipline);
        // }
        

        return $this->render('discipline_coach/index.html.twig', [
        'formDiscipline'=>$formDiscipline->createView(),
        // 'discipline' => $disciplineRepository->findAll(),
        // 'disciplines' => $disciplines,
        // dd($disciplineRepository->findAll())
        ]);
    }

    /**
     * @Route("/discipline_search", name="search", methods={"GET"})
     */
    public function search(DisciplineRepository $disciplineRepository, Request $request): Response
    {
        /*SELECT D.nom, C.nom FROM `discipline_coach` AS DC LEFT JOIN discipline D ON D.id = 
        DC.discipline_id RIGHT JOIN coach C ON C.id = DC.coach_id WHERE D.nom LIKE 'TO%'*/
        $search = '%'.$request->query->get('search').'%';
        $result = $disciplineRepository->createQueryBuilder('o')
            ->where('o.nom LIKE :nom')
            ->setParameter('nom', $search)
            ->getQuery()
            ->getResult();

        // dd($result);
        
        return $this->render('discipline_coach/index.html.twig', [
            // 'formDiscipline'=>$formDiscipline->createView(),
            // 'discipline' => $disciplineRepository->findAll(),
            'disciplines' => $result,

        ]);
    }

    /**
     * @Route("/new", name="discipline_coach_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $discipline = new Discipline();
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($discipline);
            $entityManager->flush();

            return $this->redirectToRoute('discipline_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discipline_coach/new.html.twig', [
            'discipline' => $discipline,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="discipline_coach_show", methods={"GET"})
     */
    public function show(Discipline $discipline): Response
    {
        return $this->render('discipline_coach/show.html.twig', [
            'discipline' => $discipline,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="discipline_coach_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Discipline $discipline): Response
    {
        $form = $this->createForm(DisciplineType::class, $discipline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('discipline_coach_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('discipline_coach/edit.html.twig', [
            'discipline' => $discipline,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="discipline_coach_delete", methods={"POST"})
     */
    public function delete(Request $request, Discipline $discipline): Response
    {
        if ($this->isCsrfTokenValid('delete'.$discipline->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($discipline);
            $entityManager->flush();
        }

        return $this->redirectToRoute('discipline_coach_index', [], Response::HTTP_SEE_OTHER);
    }
}
