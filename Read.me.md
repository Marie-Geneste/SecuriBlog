## Démarrage de l'application

Remplir le .env par un fichier envoyé par mp.

Symfony serve

Puis suivre le lien proposé dans le terminal.


## Explication du Blog

Blog ayant pour thème la sécurité informatique avec 2 catégories attaque et défense.
Sur la page d'acceuil ces catégories sont cliquable et trie les articles en fonction de ces dernières.

Un visiteur peut voir les articles, les trier, voir le détail d'un seul article avec ses commentaires mais il ne peut pas publier de commentaires et n'a pas de page profil.

Un utilisateur connecté peut publier un commentaire et gérer son profil sur la page dédié. Il peut supprimer ses commentaires, modifier son pseudo et supprimer son compte utilisateur. Il peut se déconnecter grâce à la navbar qui s'adapte.

Un administrateur : nayade.hera@gmail.com || admin
Ce dernier voit des boutons apparaître sur la page d'accueil rien que pour lui : il peut ajouter un article avec le bouton + à côté des catégories et il peut modifier un article avec le bouton pen en dessous des titres des articles. Il peut aussi supprimer un article dans l'éditeur de ce dernier.

Travail non fini : le responsive et la partie modération par l'admin des commentaires et des utilisateurs qui ont un statut en bdd pour pouvoir les désactiver si l'admin en ressent le besoin.