<?php

namespace App\Form;

use App\Entity\Panini;
use App\Entity\Album;
use App\Entity\Equipe;
use App\Entity\Membre;
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
        $membre = $this->membre;
        $albums = $this->membre->getAlbums();

        $builder
            ->add('nom')
            ->add('membre')
            ->add('album', EntityType::class, [
                'class' => Album::class,
                'choices' => $albums,
                'choice_label' => 'nom',
                'placeholder' => 'Choisir un album',
                'required' => true,])
            -> add('equipes', EntityType::class, [
                'class' => Equipe::class,
                'choices' => $membre ? $membre->getEquipes() : [],
                'choice_label' => 'nom',
                'placeholder' => 'Choisir une équipe',
                'required' => false,
                'multiple' => true,
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
