# Projet Wiki™
## Présentation

Wiki™ est une plateforme collaborative conçue pour explorer, créer et partager des connaissances ensemble. Le projet nécessite le développement d'un système de gestion de contenu (CMS) pour le back office et d'un front office convivial afin d'améliorer l'expérience utilisateur globale.

## Contexte du Projet

Wiki™ vise à mettre en place un système de gestion de contenu efficace ainsi qu'un front office convivial pour offrir une expérience utilisateur exceptionnelle. Le système devrait permettre aux administrateurs de gérer facilement les catégories, les tags et les wikis, tout en offrant aux auteurs la possibilité de créer, modifier et supprimer leur propre contenu.

Du côté du front office, l'accent sera mis sur une interface conviviale, avec des fonctionnalités telles qu'une inscription simplifiée, une barre de recherche efficace et des affichages dynamiques des derniers wikis et catégories pour une navigation fluide.

L'objectif principal est de créer un endroit où tout le monde peut collaborer, créer, découvrir et partager des wikis de manière facile et engageante.
Fonctionnalités Clés
## Back Office :

    Gestion des Catégories (Admin) :
        Créer, modifier et supprimer des catégories pour organiser le contenu.
        Associer plusieurs wikis à une catégorie.

    Gestion des Tags (Admin) :
        Créer, modifier et supprimer des tags pour faciliter la recherche et le regroupement du contenu.
        Associer des tags aux wikis pour une navigation plus précise.

    Inscription des Auteurs :
        Les auteurs doivent pouvoir s'inscrire sur la plateforme en fournissant des informations de base telles que le nom, l'adresse e-mail et un mot de passe sécurisé.

    Gestion des Wikis (Auteurs et Admins) :
        Les auteurs peuvent créer, modifier et supprimer leurs propres wikis.
        Les auteurs peuvent associer une seule catégorie et plusieurs tags à leurs wikis pour faciliter l'organisation et la recherche.
        Les administrateurs peuvent archiver les wikis inappropriés pour maintenir un environnement sûr et pertinent.

    Page d'Accueil du Tableau de Bord :
        Consultation des statistiques des entités via le tableau de bord.

## Front Office :

    Connexion et Inscription :
        Les utilisateurs peuvent créer un compte (Inscription) en fournissant des informations de base.
        Les utilisateurs peuvent se connecter (Connexion) à leurs comptes existants. Les administrateurs sont redirigés vers le tableau de bord, les autres vers la page d'accueil.

    Barre de Recherche :
        Une barre de recherche est disponible pour permettre aux visiteurs de rechercher des wikis, des catégories et des tags sans nécessiter d'actualisation de la page (utilisation de AJAX).

    Affichage des Derniers Wikis :
        La page d'accueil ou une section dédiée doit afficher les derniers wikis ajoutés sur la plateforme, offrant ainsi aux utilisateurs un accès rapide au contenu le plus récent.

    Affichage des Dernières Catégories :
        Une section distincte doit présenter les dernières catégories créées ou mises à jour, permettant aux utilisateurs de découvrir rapidement les thèmes récemment ajoutés à la plateforme.

    Redirection vers la Page Unique des Wikis :
        En cliquant sur un wiki, les utilisateurs doivent être redirigés vers une page unique dédiée à ce wiki, offrant des détails complets tels que le contenu, les catégories associées, les tags et les informations sur l'auteur.

## Technologies
### Frontend :

    HTML5
    Cadre CSS
    JavaScript

### Backend :

    PHP 8 avec architecture MVC

### Base de Données :

    Pilote PDO