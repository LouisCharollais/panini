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
        //dump($options);
        $equipe = $options['data'] ?? null;
        $membre = $equipe->getCreateur();

        $builder
            ->add('createur', null, [
                'disabled'   => true,
            ])
            ->add('Paninis', EntityType::class, [
                'class' => 'App\Entity\Panini',
                'choice_label' => 'nom',
                'multiple' => true,
                'query_builder' => function (PaniniRepository $er) use ($membre) {
                                                return $er->createQueryBuilder('o')
                                                    ->leftJoin('o.album', 'i')
                                                    ->andWhere('i.membre = :membre')
                                                    ->setParameter('membre', $membre)
                                                    ;
                                                }
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
