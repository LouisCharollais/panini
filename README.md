# Panini
Louis CHAROLLAIS
Site de collection de cartes panini

Nomenclature :
    - Album : Inventaire
    - Panini : Objet
    - Membre : Membre
    - Galerie : pas encore fait

Commandes utiles
symfony console make:entity
symfony console doctrine:database:create
symfony console doctrine:schema:create
symfony console doctrine:fixtures:load

en cas de soucis, on peut recréer la base de données (à vide) :
suppression de la base (symfony console doctrine:database:drop)
re-création de la base (symfony console doctrine:database:create)
re-création du schéma (symfony console doctrine:schema:create)


TODO LIST
1 : prise de connaissance du cahier des charges                                                 OK
2 : initialisation du projet Symfony                                                            OK
3 : gestion du code source avec Git                                                             OK
4 : ajout au modèle des entités liées Album et Panini                                           OK
        entité Album                                                                            OK
        entité Panini                                                                           OK
        association 1-N entre Album et Panini                                                   OK
        propriétés non essentielles des Paninis                                                 OK
5 : ajout de données de test chargeables avec fixtures                                          OK
        pour Album                                                                              OK                            
        pour Panini                                                                             OK
6 : ajout d'une interface EasyAdmin dans le back-office avec les 2 contrôleurs CRUD             OK
        pour Album                                                                              OK
        pour Panini                                                                             OK
        navigation entre Album et ses Paninis                                                   OK
7 : ajout de l'entité Membre et du lien Membre-Album                                            OK
        ajout de Membre au modèle de données                                                    OK
        ajout de l'association 1-N entre Membre et Album                                        OK
8 : création des pages du "front-office" de consultation des Album                              OK
        consultation de la liste des Albums                                                     OK
        consultation d'une fiche d'Album à partir de la liste                                   OK
9 : ajout de la navigation entre Album et Panini dans le back-office                        NON
10 : utilisation de gabarits pour les pages de consultation du front-office                 NON
        consultation d'un Panini                                                            NON
        consultation de la liste des Paninis d'un Album                                     NON
        navigation d'un Album vers la consultation de ses Paninis                           NON
11 : intégration d'une mise en forme CSS avec Bootstrap dans les gabarits Twig              NON
12 : intégration de menus de navigation                                                     NON
13 : ajout de l'entité [galerie] au modèle des données et de l'association M-N avec Panini  NON
14 : ajout de [galerie] dans le back-office                                                 NON
15 : ajout d'un contrôleur CRUD au front-office pour [galerie]                              NON
16 : ajout de fonctions CRUD au front-office pour Album                                     NON
17 : ajout de la consultation des Paninis depuis les [galeries] publiques                   NON
18 : ajout d'un contrôleur CRUD pour Membres                                                NON
19 : consultation de la liste des seuls inventaires d'un membre dans le front-office        NON
20 : contextualisation de la création d'Album en fonction du Membre                         NON
21 : contextualisation de la création d'un Panini en fonction de l'Album                    NON
22 : contextualisation de la création d'une [galerie] en fonction du membre                 NON
23 : affichage des seules galeries publiques                                                NON
24 : contextualisation de l'ajout d'un Panini à une [galerie]                               NON
25 : ajout des Utilisateurs au modèle de données et du lien utilisateur - membre            NON
26 : ajout de l'authentification                                                            NON
27 : protection de l'accès aux routes interdites réservées aux membres                      NON
28 : protection de l'accès aux données à leurs seuls propriétaires                          NON
29 : contextualisation du chargement des données en fonction de l'utilisateur connecté      NON
30 : Gestion de la suppression                                                              NON
31 : ajout de la gestion de la mise en ligne d'images pour des photos dans les Paninis      NON
32 : utilisation des messages flash pour les CRUDs                                          NON
33 : ajout d'une gestion de marque-pages/panier dans le front-office                        NON