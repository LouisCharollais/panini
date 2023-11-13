<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Panini;
use App\Repository\PaniniRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $album = $options['data'] ?? null;
        $membre = $album->getMembre();

        $builder
            ->add('nom')
            ->add('paninis', EntityType::class, [
                'class' => Panini::class,
                'query_builder' => function (PaniniRepository $er) use ($membre) {
                    return $er->createQueryBuilder('panini')
                        ->join('panini.album', 'album')
                        ->join('album.membre', 'membre')
                        ->andWhere('membre = :createur')
                        ->setParameter('createur', $membre);
                },
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un panini',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
