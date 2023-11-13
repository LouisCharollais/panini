<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Membre;
use App\Entity\Panini;
use App\Entity\Equipe;
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

        $membre_1 = new Membre();
        $membre_1->setNom('test_nom_1');
        $membre_1->setPrenom('test_prenom_1');
        $membre_1->__construct();

        $album = new Album();
        $album->__construct();
        $album->setNom('album_test');
        $album->setMembre($membre);
        $membre->addAlbum($album);

        $panini_1 = new Panini();
        $panini_1->setNom('carte_1');
        $panini_1->setAlbum($album);
        $album->addPanini($panini_1);

        $panini_2 = new Panini();
        $panini_2->setNom('carte_2');
        $panini_2->setAlbum($album);
        $album->addPanini($panini_2);

        $equipe_1 = new Equipe();
        $equipe_1->setNom('équipe_1');
        $equipe_1->addPanini($panini_1);
        $equipe_1->addPanini($panini_2);
        $equipe_1->setCreateur($membre);

        $manager->persist($membre);
        $manager->persist($membre_1);
        $manager->persist($album);
        $manager->persist($panini_1);
        $manager->persist($panini_2);
        $manager->persist($equipe_1);

        $manager->flush();

    }
}
