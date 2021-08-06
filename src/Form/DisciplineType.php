<?php

namespace App\Form;

use App\Repository\DisciplineRepository;
use App\Entity\Discipline;
use App\Entity\Coach;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class DisciplineType extends AbstractType
{
    private $disciplineRepository;
    public function __construct(DisciplineRepository $disciplineRepository)
    {
        $this->disciplineRepository = $disciplineRepository;
    }

    private function getDisciplineRepository(): DisciplineRepository
    {
        return $this->disciplineRepository->getRepository(Discipline::class);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // ->add('nom')
            // ->add('Coach');
            ->add('nom', EntityType::class,
        [
            'attr' => ['class' =>'form-control form-control-lg form-control-borderless'],
            'label' => false,
            'placeholder'=>'Disciplines',
            'class'=>Discipline::class,
            // 'multiple'=> false,
            'choices' => $this->disciplineRepository->findAll(),
            // 'choice_value' => 'id',
            // 'choice_value' => function(?Discipline $discipline) {
            //     return $discipline ? ($discipline->getId()) : -1;
            // },
            'choice_label' => "nom",
            'query_builder' => function(EntityRepository $er){
                return $er->createQueryBuilder('n')
                ->orderBy('n.nom');
            }
        ])
        // ->add('Coach', EntityType::class,[
        //     'class'=>Coach::class,
        //     'attr' => ['class' =>'hidden'],
        //     'label' => false,
        //     'multiple'=> true,
        //     'required'   => false,
        //     'choice_label' => function(?Coach $Coach) {
        //                return $Coach ? strtoupper($Coach->getNom()) : '';
        //     }
        // ])
        ->add('submit', SubmitType::class, [
                'label' => 'Chercher',
                'attr' => ['class' =>'btn btn-lg btn-recherche'],
                
        ]);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Discipline::class,
        ]);
    }
}
