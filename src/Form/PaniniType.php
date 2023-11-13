<?php

namespace App\Form;

use App\Entity\Panini;
use App\Entity\Album;
use App\Entity\Equipe;
use App\Entity\Membre;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PaniniType extends AbstractType
{
    private Membre $membre;

    public function __construct(Membre $membre)
    {
        $this->membre = $membre;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $albumRef = $options['data'] ?? null;
        $membre = $albumRef ? $albumRef->getMembre() : $this->membre;

        $builder
            ->add('nom')
            ->add('membre', EntityType::class, [
                'class' => Membre::class,
                'choice_label' => 'nom',
                'data' => $membre,
                'disabled' => true,
                'required' => true,
            ])

            ->add('album', EntityType::class, [
                'class' => Album::class,
                'query_builder' => function (EntityRepository $er) use ($membre) {
                    return $er->createQueryBuilder('a')
                        ->andWhere('a.membre = :membre')
                        ->setParameter('membre', $membre);
                },
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un album',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Panini::class,
        ]);
    }
}
