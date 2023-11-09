<?php

namespace App\Controller\Admin;

use App\Entity\Panini;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PaniniCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Panini::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('nom'),
            AssociationField::new('album'),
            AssociationField::new('equipes')
                ->onlyOnDetail()
                ->setTemplatePath('admin/fields/equipe_paninis.html.twig')
        ];
    }

    public function configureActions(Actions $actions): Actions
    {

        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ;
    }
}