<?php

namespace App\DataFixtures;

use App\Entity\Album;
use App\Entity\Membre;
use App\Entity\Panini;
use App\Entity\Equipe;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $password = $this->hasher->hashPassword($user, 'password123');
        $user->setEmail('louis@localhost');
        $user->setPassword($password);
        $user->setRoles(['ROLE_USER']);

        $user_admin = new User();
        $password = $this->hasher->hashPassword($user_admin, 'password456');
        $user_admin->setEmail('admin@localhost');
        $user_admin->setPassword($password);
        $user_admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $membre_1 = new Membre();
        $membre_1->setNom('test_nom_1');
        $membre_1->setUser($user);
        $membre_1->setPrenom('test_prenom_1');

        $membre_2 = new Membre();
        $membre_2->setNom('test_nom_2');
        $membre_2->setUser($user_admin);
        $membre_2->setPrenom('test_prenom_2');

        $album_1 = new Album();
        $album_1->__construct();
        $album_1->setNom('album_1');
        $album_1->setMembre($membre_1);
        $membre_1->addAlbum($album_1);

        $album_2 = new Album();
        $album_2->__construct();
        $album_2->setNom('album_2');
        $album_2->setMembre($membre_2);
        $membre_2->addAlbum($album_2);

        $panini_test_1 = new Panini();
        $panini_test_1->setNom('Olivier Giroud');
        $panini_test_1->setAlbum($album_2);
        $panini_test_1->setImageName('olivier_giroud.jpg');
        $album_2->addPanini($panini_test_1);

        $panini_test_2 = new Panini();
        $panini_test_2->setNom('Kyliann Mbappé');
        $panini_test_2->setAlbum($album_2);
        $panini_test_2->setImageName('kyliann_mbappe.jpg');
        $album_2->addPanini($panini_test_2);

        $panini_1 = new Panini();
        $panini_1->setNom('Mike Maignan');
        $panini_1->setAlbum($album_1);
        $panini_1->setImageName('mike_maignan.jpg');
        $album_1->addPanini($panini_1);

        $panini_2 = new Panini();
        $panini_2->setNom('Brice Samba');
        $panini_2->setAlbum($album_1);
        $panini_2->setImageName('brice_samba.jpg');
        $album_1->addPanini($panini_2);

        $panini_3 = new Panini();
        $panini_3->setNom('Alphonse Areola');
        $panini_3->setAlbum($album_1);
        $panini_3->setImageName('alphonse_areola.jpg');
        $album_1->addPanini($panini_3);

        $panini_4 = new Panini();
        $panini_4->setNom('Lucas Hernandez');
        $panini_4->setAlbum($album_1);
        $panini_4->setImageName('lucas_hernandez.jpg');
        $album_1->addPanini($panini_4);

        $panini_5 = new Panini();
        $panini_5->setNom('Théo Hernandez');
        $panini_5->setAlbum($album_1);
        $panini_5->setImageName('theo_hernandez.jpg');
        $album_1->addPanini($panini_5);

        $panini_6 = new Panini();
        $panini_6->setNom('Jonathan Clauss');
        $panini_6->setAlbum($album_1);
        $panini_6->setImageName('jonathan_clauss.jpg');
        $album_1->addPanini($panini_6);

        $panini_7 = new Panini();
        $panini_7->setNom('Ibrahima Konaté');
        $panini_7->setAlbum($album_1);
        $panini_7->setImageName('ibrahima_konate.jpg');
        $album_1->addPanini($panini_7);

        $panini_8 = new Panini();
        $panini_8->setNom('Jules Koundé');
        $panini_8->setAlbum($album_1);
        $panini_8->setImageName('jules_kounde.jpg');
        $album_1->addPanini($panini_8);

        $panini_9 = new Panini();
        $panini_9->setNom('Jean-Clair Todibo');
        $panini_9->setAlbum($album_1);
        $panini_9->setImageName('jeanclair_todibo.jpg');
        $album_1->addPanini($panini_9);

        $panini_10 = new Panini();
        $panini_10->setNom('William Saliba');
        $panini_10->setAlbum($album_1);
        $panini_10->setImageName('william_saliba.jpg');
        $album_1->addPanini($panini_10);

        $panini_11 = new Panini();
        $panini_11->setNom('Dayot Upamecano');
        $panini_11->setAlbum($album_1);
        $panini_11->setImageName('dayot_upamecano.jpg');
        $album_1->addPanini($panini_11);

        $panini_12 = new Panini();
        $panini_12->setNom('Eduardo Camavinga');
        $panini_12->setAlbum($album_1);
        $panini_12->setImageName('eduardo_camavinga.jpg');
        $album_1->addPanini($panini_12);

        $panini_13 = new Panini();
        $panini_13->setNom('Warren Zaïre-Emery');
        $panini_13->setAlbum($album_1);
        $panini_13->setImageName('warren_zaireemery.jpg');
        $album_1->addPanini($panini_13);

        $panini_14 = new Panini();
        $panini_14->setNom('Boubakar Kamara');
        $panini_14->setAlbum($album_1);
        $panini_14->setImageName('boubakar_kamara.jpg');
        $album_1->addPanini($panini_14);

        $panini_15 = new Panini();
        $panini_15->setNom('Adrien Rabiot');
        $panini_15->setAlbum($album_1);
        $panini_15->setImageName('adrien_rabiot.jpg');
        $album_1->addPanini($panini_15);

        $panini_16 = new Panini();
        $panini_16->setNom('Youssouf Fofana');
        $panini_16->setAlbum($album_1);
        $panini_16->setImageName('youssouf_fofana.jpg');
        $album_1->addPanini($panini_16);

        $panini_17 = new Panini();
        $panini_17->setNom('Randall Kolo Muani');
        $panini_17->setAlbum($album_1);
        $panini_17->setImageName('randall_kolomuani.jpg');
        $album_1->addPanini($panini_17);

        $panini_18 = new Panini();
        $panini_18->setNom('Kingsley Coman');
        $panini_18->setAlbum($album_1);
        $panini_18->setImageName('kingsley_coman.jpg');
        $album_1->addPanini($panini_18);

        $panini_19 = new Panini();
        $panini_19->setNom('Olivier Giroud');
        $panini_19->setAlbum($album_1);
        $panini_19->setImageName('olivier_giroud.jpg');
        $album_1->addPanini($panini_19);

        $panini_20 = new Panini();
        $panini_20->setNom('Ousmane Dembélé');
        $panini_20->setAlbum($album_1);
        $panini_20->setImageName('ousmane_dembele.jpg');
        $album_1->addPanini($panini_20);

        $panini_21 = new Panini();
        $panini_21->setNom('Kyliann Mbappé');
        $panini_21->setAlbum($album_1);
        $panini_21->setImageName('kyliann_mbappe.jpg');
        $album_1->addPanini($panini_21);

        $panini_22 = new Panini();
        $panini_22->setNom('Marcus Thuram');
        $panini_22->setAlbum($album_1);
        $panini_22->setImageName('marcus_thuram.jpg');
        $album_1->addPanini($panini_22);

        $panini_23 = new Panini();
        $panini_23->setNom('Antoine Griezmann');
        $panini_23->setAlbum($album_1);
        $panini_23->setImageName('antoine_griezmann.jpg');
        $album_1->addPanini($panini_23);

        $panini_24 = new Panini();
        $panini_24->setNom('Alisson Becker');
        $panini_24->setAlbum($album_1);
        $panini_24->setImageName('alisson_becker.jpg');
        $album_1->addPanini($panini_24);

        $panini_25 = new Panini();
        $panini_25->setNom('Ederson');
        $panini_25->setAlbum($album_1);
        $panini_25->setImageName('ederson.jpg');
        $album_1->addPanini($panini_25);

        $panini_26 = new Panini();
        $panini_26->setNom('Alex Sandro');
        $panini_26->setAlbum($album_1);
        $panini_26->setImageName('alex_sandro.jpg');
        $album_1->addPanini($panini_26);

        $panini_27 = new Panini();
        $panini_27->setNom('Bremer Souza');
        $panini_27->setAlbum($album_1);
        $panini_27->setImageName('bremer_souza.jpg');
        $album_1->addPanini($panini_27);

        $panini_28 = new Panini();
        $panini_28->setNom('Dani Alves');
        $panini_28->setAlbum($album_1);
        $panini_28->setImageName('dani_alves.jpg');
        $album_1->addPanini($panini_28);

        $panini_29 = new Panini();
        $panini_29->setNom('Danilo');
        $panini_29->setAlbum($album_1);
        $panini_29->setImageName('danilo.jpg');
        $album_1->addPanini($panini_29);

        $panini_30 = new Panini();
        $panini_30->setNom('Marquinhos');
        $panini_30->setAlbum($album_1);
        $panini_30->setImageName('marquinhos.jpg');
        $album_1->addPanini($panini_30);

        $panini_31 = new Panini();
        $panini_31->setNom('Eder Militão');
        $panini_11->setAlbum($album_1);
        $panini_31->setImageName('eder_militao.jpg');
        $album_1->addPanini($panini_31);

        $panini_32 = new Panini();
        $panini_32->setNom('Alex Telles');
        $panini_32->setAlbum($album_1);
        $panini_32->setImageName('alex_telles.jpg');
        $album_1->addPanini($panini_32);

        $panini_33 = new Panini();
        $panini_33->setNom('Thiago Silva');
        $panini_33->setAlbum($album_1);
        $panini_33->setImageName('thiago_silva.jpg');
        $album_1->addPanini($panini_33);

        $panini_34 = new Panini();
        $panini_34->setNom('Casemiro');
        $panini_34->setAlbum($album_1);
        $panini_34->setImageName('casemiro.jpg');
        $album_1->addPanini($panini_34);

        $panini_35 = new Panini();
        $panini_35->setNom('Everton Ribeiro');
        $panini_35->setAlbum($album_1);
        $panini_35->setImageName('everton_ribeiro.jpg');
        $album_1->addPanini($panini_35);

        $panini_36 = new Panini();
        $panini_36->setNom('Fabinho');
        $panini_36->setAlbum($album_1);
        $panini_36->setImageName('fabinho.jpg');
        $album_1->addPanini($panini_36);

        $panini_37 = new Panini();
        $panini_37->setNom('Fred');
        $panini_37->setAlbum($album_1);
        $panini_37->setImageName('fred.jpg');
        $album_1->addPanini($panini_37);

        $panini_38 = new Panini();
        $panini_38->setNom('Guimarães');
        $panini_38->setAlbum($album_1);
        $panini_38->setImageName('guimaraes.jpg');
        $album_1->addPanini($panini_38);

        $panini_39 = new Panini();
        $panini_39->setNom('Lucas Paquetá');
        $panini_39->setAlbum($album_1);
        $panini_39->setImageName('lucas_paqueta.jpg');
        $album_1->addPanini($panini_39);

        $panini_40 = new Panini();
        $panini_40->setNom('Antony');
        $panini_40->setAlbum($album_1);
        $panini_40->setImageName('antony.jpg');
        $album_1->addPanini($panini_40);

        $panini_41 = new Panini();
        $panini_41->setNom('Gabriel Jesus');
        $panini_41->setAlbum($album_1);
        $panini_41->setImageName('gabriel_jesus.jpg');
        $album_1->addPanini($panini_41);

        $panini_42 = new Panini();
        $panini_42->setNom('Gabriel Martinelli');
        $panini_42->setAlbum($album_1);
        $panini_42->setImageName('gabriel_martinelli.jpg');
        $album_1->addPanini($panini_42);

        $panini_43 = new Panini();
        $panini_43->setNom('Neymar Jr');
        $panini_43->setAlbum($album_1);
        $panini_43->setImageName('neymar_jr.jpg');
        $album_1->addPanini($panini_43);

        $panini_44 = new Panini();
        $panini_44->setNom('Joao Pedro');
        $panini_44->setAlbum($album_1);
        $panini_44->setImageName('joao_pedro.jpg');
        $album_1->addPanini($panini_44);

        $panini_45 = new Panini();
        $panini_45->setNom('Raphinha');
        $panini_45->setAlbum($album_1);
        $panini_45->setImageName('raphinha.jpg');
        $album_1->addPanini($panini_45);

        $panini_46 = new Panini();
        $panini_46->setNom('Richarlison');
        $panini_46->setAlbum($album_1);
        $panini_46->setImageName('richarlison.jpg');
        $album_1->addPanini($panini_46);

        $panini_47 = new Panini();
        $panini_47->setNom('Rodrygo');
        $panini_47->setAlbum($album_1);
        $panini_47->setImageName('rodrygo.jpg');
        $album_1->addPanini($panini_47);

        $panini_48 = new Panini();
        $panini_48->setNom('Vinicius Jr');
        $panini_48->setAlbum($album_1);
        $panini_48->setImageName('vinicius_jr.jpg');
        $album_1->addPanini($panini_48);

        $equipe_1 = new Equipe();
        $equipe_1->setNom('équipe de France');
        $equipe_1->setPublished(true);
        $equipe_1->addPanini($panini_1);
        $equipe_1->addPanini($panini_2);
        $equipe_1->addPanini($panini_3);
        $equipe_1->addPanini($panini_4);
        $equipe_1->addPanini($panini_5);
        $equipe_1->addPanini($panini_6);
        $equipe_1->addPanini($panini_7);
        $equipe_1->addPanini($panini_8);
        $equipe_1->addPanini($panini_9);
        $equipe_1->addPanini($panini_10);
        $equipe_1->addPanini($panini_11);
        $equipe_1->addPanini($panini_12);
        $equipe_1->addPanini($panini_13);
        $equipe_1->addPanini($panini_14);
        $equipe_1->addPanini($panini_15);
        $equipe_1->addPanini($panini_16);
        $equipe_1->addPanini($panini_17);
        $equipe_1->addPanini($panini_18);
        $equipe_1->addPanini($panini_19);
        $equipe_1->addPanini($panini_20);
        $equipe_1->addPanini($panini_21);
        $equipe_1->addPanini($panini_22);
        $equipe_1->addPanini($panini_23);
        $equipe_1->setCreateur($membre_1);

        $equipe_2 = new Equipe();
        $equipe_2->setNom('équipe du Brésil');
        $equipe_2->setPublished(true);
        $equipe_2->addPanini($panini_24);
        $equipe_2->addPanini($panini_25);
        $equipe_2->addPanini($panini_26);
        $equipe_2->addPanini($panini_27);
        $equipe_2->addPanini($panini_28);
        $equipe_2->addPanini($panini_29);
        $equipe_2->addPanini($panini_30);
        $equipe_2->addPanini($panini_31);
        $equipe_2->addPanini($panini_32);
        $equipe_2->addPanini($panini_33);
        $equipe_2->addPanini($panini_34);
        $equipe_2->addPanini($panini_35);
        $equipe_2->addPanini($panini_36);
        $equipe_2->addPanini($panini_37);
        $equipe_2->addPanini($panini_38);
        $equipe_2->addPanini($panini_39);
        $equipe_2->addPanini($panini_40);
        $equipe_2->addPanini($panini_41);
        $equipe_2->addPanini($panini_42);
        $equipe_2->addPanini($panini_43);
        $equipe_2->addPanini($panini_44);
        $equipe_2->addPanini($panini_45);
        $equipe_2->addPanini($panini_46);
        $equipe_2->addPanini($panini_47);
        $equipe_2->addPanini($panini_48);
        $equipe_2->setCreateur($membre_2);

        $manager->persist($membre_1);
        $manager->persist($membre_2);

        $manager->persist($album_1);
        $manager->persist($album_2);

        $manager->persist($panini_1);
        $manager->persist($panini_2);
        $manager->persist($panini_3);
        $manager->persist($panini_4);
        $manager->persist($panini_5);
        $manager->persist($panini_6);
        $manager->persist($panini_7);
        $manager->persist($panini_8);
        $manager->persist($panini_9);
        $manager->persist($panini_10);
        $manager->persist($panini_11);
        $manager->persist($panini_12);
        $manager->persist($panini_13);
        $manager->persist($panini_14);
        $manager->persist($panini_15);
        $manager->persist($panini_16);
        $manager->persist($panini_17);
        $manager->persist($panini_18);
        $manager->persist($panini_19);
        $manager->persist($panini_20);
        $manager->persist($panini_21);
        $manager->persist($panini_22);
        $manager->persist($panini_23);
        $manager->persist($panini_24);
        $manager->persist($panini_25);
        $manager->persist($panini_26);
        $manager->persist($panini_27);
        $manager->persist($panini_28);
        $manager->persist($panini_29);
        $manager->persist($panini_30);
        $manager->persist($panini_31);
        $manager->persist($panini_32);
        $manager->persist($panini_33);
        $manager->persist($panini_34);
        $manager->persist($panini_35);
        $manager->persist($panini_36);
        $manager->persist($panini_37);
        $manager->persist($panini_38);
        $manager->persist($panini_39);
        $manager->persist($panini_40);
        $manager->persist($panini_41);
        $manager->persist($panini_42);
        $manager->persist($panini_43);
        $manager->persist($panini_44);
        $manager->persist($panini_45);
        $manager->persist($panini_46);
        $manager->persist($panini_47);
        $manager->persist($panini_48);
        $manager->persist($panini_test_1);
        $manager->persist($panini_test_2);

        $manager->persist($equipe_1);
        $manager->persist($equipe_2);

        $manager->flush();
    }
}
