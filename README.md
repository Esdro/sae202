# Projet SAE 202 : Disco Murder - IUT de Troyes

## Objectif du Projet

Créer un site web promotionnel pour un événement, incluant un système de réservation, d'inscription utilisateur, une messagerie interne et la gestion de commentaires.

## Fonctionnalités Obligatoires

### Site Public (Responsive)
*   **Page d'accueil :** Présentation de l'événement et affichage des commentaires approuvés.
*   **Page concept :** Explication du principe de l'événement.
*   **Page infos pratiques :** Localisation, accès, etc.
*   **Système d'inscription et de connexion** pour les participants.

### Accès Privé (Participants Connectés)
*   **Page messagerie :** Pour contacter les administrateurs du site (messagerie interne en base de données).
*   **Formulaire de proposition de commentaire.**
*   **Page profil :** Pour renseigner des informations personnelles (téléphone, email, etc.).
*   **Une ou plusieurs pages de mentions légales.**

### Back-Office (Administrateurs)
*   **Liste des inscrits :** Visualisation des informations des utilisateurs (nom, prénom, âge, etc.).
*   **Modération des commentaires :** Accepter ou refuser les commentaires soumis par les utilisateurs.

## Fonctionnalité Optionnelle
*   Une version en anglais du site.

## Spécifications Techniques

*   **URL du site :** `https://mmi24f07.sae202.ovh`
*   **URL du back-office :** `https://mmi24f07.sae202.ovh/gestion`
*   **Dossier du site sur le serveur :** `/var/www/sae202`
*   **Dossier du back-office sur le serveur :** `/var/www/sae202/admin` (protégé)
*   **Base de données :**
    *   Nom : `sae202` (MySQL)
    *   Compte utilisateur et mot de passe : Libres
    *   Nom des tables : Explicites (ex: `utilisateurs`, `messages`, `commentaires`)

## Consignes Supplémentaires
*   Les utilisateurs doivent s'inscrire pour pouvoir réserver.
*   Les commentaires sont publiés sur la page d'accueil après approbation d'un administrateur.
*   Liberté de développer des