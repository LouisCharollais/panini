<?php

namespace App\Form;

use App\Entity\Album;
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
            ->add('Paninis', EntityType::class, [
                'class' => 'App\Entity\Panini',
                'choice_label' => 'nom',
                'by_reference' => false,
                'multiple' => true,
                'expanded' => true,
                'query_builder' => function (PaniniRepository $paniniRepository) use ($membre, $album) {
                    return $paniniRepository->createQueryBuilder('p')
                        ->join('p.album', 'album')
                        ->join('album.membre', 'membre')
                        ->where('album = :album')
                        ->andWhere('membre = :membre')
                        ->setParameter('album', $album)
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
            'data_class' => Album::class,
        ]);
    }
}
