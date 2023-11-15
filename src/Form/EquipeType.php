<?php

namespace App\Form;

use App\Entity\Equipe;
use App\Repository\PaniniRepository;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use App\Entity\Panini;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $equipe = $options['data'] ?? null;
        $createur = $equipe->getCreateur();

        $builder
            ->add('nom', EntityType::class,[
                'class' => 'App\Entity\Equipe',
                'choice_label' => 'nom',
                    'data' => $equipe,
                    'disabled' => true,
                    'required' => true,
                ]
            )
            ->add('paninis', EntityType::class, [
                'class' => Panini::class,
                'query_builder' => function (PaniniRepository $er) use ($createur) {
                    return $er->createQueryBuilder('panini')
                        ->join('panini.album', 'album')
                        ->join('album.membre', 'membre')
                        ->andWhere('membre = :createur')
                        ->setParameter('createur', $createur);
                },
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un panini',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            ])
        ;


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Equipe::class,
        ]);
    }
}