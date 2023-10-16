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


## TODO LIST

- [x] 1 : Prise de connaissance du cahier des charges
- [x] 2 : Initialisation du projet Symfony
- [x] 3 : Gestion du code source avec Git
- [x] 4 : Ajout au modèle des entités liées Album et Panini
    - [x] Entité Album
    - [x] Entité Panini
    - [x] Association 1-N entre Album et Panini
    - [x] Propriétés non essentielles des Paninis
- [x] 5 : Ajout de données de test chargeables avec fixtures
    - [x] Pour Album
    - [x] Pour Panini
- [x] 6 : Ajout d'une interface EasyAdmin dans le back-office avec les 2 contrôleurs CRUD
    - [x] Pour Album
    - [x] Pour Panini
    - [x] Navigation entre Album et ses Paninis
- [x] 7 : Ajout de l'entité Membre et du lien Membre-Album
    - [x] Ajout de Membre au modèle de données
    - [x] Ajout de l'association 1-N entre Membre et Album
- [x] 8 : Création des pages du "front-office" de consultation des Albums
    - [x] Consultation de la liste des Albums
    - [x] Consultation d'une fiche d'Album à partir de la liste
- [ ] 9 : Ajout de la navigation entre Album et Panini dans le back-office
- [ ] 10 : Utilisation de gabarits pour les pages de consultation du front-office
    - [ ] Consultation d'un Panini
    - [ ] Consultation de la liste des Paninis d'un Album
    - [ ] Navigation d'un Album vers la consultation de ses Paninis
- [ ] 11 : Intégration d'une mise en forme CSS avec Bootstrap dans les gabarits Twig
- [ ] 12 : Intégration de menus de navigation
- [ ] 13 : Ajout de l'entité [galerie] au modèle des données et de l'association M-N avec Panini
- [ ] 14 : Ajout de [galerie] dans le back-office
- [ ] 15 : Ajout d'un contrôleur CRUD au front-office pour [galerie]
- [ ] 16 : Ajout de fonctions CRUD au front-office pour Album
- [ ] 17 : Ajout de la consultation des Paninis depuis les [galeries] publiques
- [ ] 18 : Ajout d'un contrôleur CRUD pour Membres
- [ ] 19 : Consultation de la liste des seuls inventaires d'un membre dans le front-office
- [ ] 20 : Contextualisation de la création d'Album en fonction du Membre
- [ ] 21 : Contextualisation de la création d'un Panini en fonction de l'Album
- [ ] 22 : Contextualisation de la création d'une [galerie] en fonction du membre
- [ ] 23 : Affichage des seules galeries publiques
- [ ] 24 : Contextualisation de l'ajout d'un Panini à une [galerie]
- [ ] 25 : Ajout des Utilisateurs au modèle de données et du lien utilisateur - membre
- [ ] 26 : Ajout de l'authentification
- [ ] 27 : Protection de l'accès aux routes interdites réservées aux membres
- [ ] 28 : Protection de l'accès aux données à leurs seuls propriétaires
- [ ] 29 : Contextualisation du chargement des données en fonction de l'utilisateur connecté
- [ ] 30 : Gestion de la suppression
- [ ] 31 : Ajout de la gestion de la mise en ligne d'images pour des photos dans les Paninis
- [ ] 32 : Utilisation des messages flash pour les CRUDs
- [ ] 33 : Ajout d'une gestion de marque-pages/panier dans le front-office