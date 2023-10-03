<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $album = new Album();
        $album->__construct();
        $album->getId();
        $album->getPaninis();
        $album->addPanini(new Panini());
        $album->removePanini(new Panini());
        $album->getMembres();
        $album->setMembres(new Membre());

        $panini = new Panini();
        $panini->__construct();
        $panini->getId();
        $panini->getDescription();
        $panini->setDescription('fixture');
        $panini->getAlbum();
        $panini->setAlbum(new Album());

    }
}
