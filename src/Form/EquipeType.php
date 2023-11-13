<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Repository\PaniniRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $equipe = $options['data'] ?? null;
        $membre = $equipe->getCreateur();

        $builder
            ->add('nom')
            ->add('Paninis', EntityType::class, [
                'class' => 'App\Entity\Panini',
                'choice_label' => 'nom',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (PaniniRepository $paniniRepository) use ($membre, $equipe) {
                    return $paniniRepository->createQueryBuilder('p')
                        ->join('p.equipes', 'equipe')
                        ->join('equipe.createur', 'membre')
                        ->where('equipe = :equipe')
                        ->andWhere('membre = :membre')
                        ->setParameter('equipe', $equipe)
                        ->setParameter('membre', $membre)
                        ->orderBy('p.nom', 'ASC')
                        ;
                },
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}