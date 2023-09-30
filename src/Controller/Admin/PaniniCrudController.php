<?php

namespace App\Controller\Admin;

use App\Entity\Panini;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
            TextField::new('description'),
            AssociationField::new('Album')
        ];
    }

}
