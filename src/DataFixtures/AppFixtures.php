<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Membre;
use App\Entity\Panini;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $membre = new Membre();
        $membre->setNom('test_nom');
        $membre->setPrenom('test_prenom');
        $membre->__construct();

        $album = new Album();
        $album->__construct();
        $album->setNom('album_test');
        $album->setMembre($membre);
        $membre->addAlbum($album);

        $panini = new Panini();
        //$panini->__construct();
        //$panini->getId();
        //$panini->getDescription();
        $panini->setDescription('carte_1');
        //$panini->getAlbum();
        $panini->setAlbum($album);
        $album->addPanini($panini);

        $panini = new Panini();
        //$panini->__construct();
        //$panini->getId();
        //$panini->getDescription();
        $panini->setDescription('carte_2');
        //$panini->getAlbum();
        $panini->setAlbum($album);
        $album->addPanini($panini);

        $manager->persist($membre);
        $manager->persist($album);
        $manager->persist($panini);

        $manager->flush();

    }
}
