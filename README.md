# Panini
Louis CHAROLLAIS
Site de collection de cartes panini

Nomenclature :
    - Album : Inventaire
    - Panini : Objet
    - Membre : Membre
    - Galerie : Equipe

User :
email : louis@localhost
mdp   : password123

Admin :
email : admin@localhost
mdp   : password456

'Accueil' envoie à la page avec la liste des Albums et des Equipes du membre (privées et publiques)
'Equipes' envoie à la page avec la liste des équipes publiques (du membre et des autres)

Pour voir les détails d'un panini, il faut suivre Accueil --> Equipe et cliquer sur une image
                                                  Accueil --> Album  et cliquer sur une image

Le bouton 'Rendre Publique/Privé' dans la page de détail d'une équipe permet de régler la visibilité de l'équipe

On peut ajouter/retirer un panini d'une équipe à partir du bouton en bas de page (choix parmi les paninis présents dans les albums appartenant au membre connecté)
idem pour le cas d'un album, mais si on supprime un panini d'un album, le panini est supprimé définitivement car il n'y a pas d'association Membre-Panini

Je n'ai pas eu le temps de rajouter la fonctionnalité permettant de rajouter une image au panini qu'on crée, mais c'était dans les plans :)