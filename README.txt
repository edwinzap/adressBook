Auteur: Miguel FORGET
Date de fin: 04/02/2017
Cours: PHP-ESA

Le projet AdressBook � pour objectif de cr�er un carnet d'adresse.
Celui-ci utilise une database MySql (cr�er avec PHPMyAdmin). Les scripts de cr�ation des tables se trouvent dans le dossier /Scripts/

Le projet offre les fonctionnalit�s suivantes:

- Cr�er un utilisateur (login + password)
- Se connecter avec un utilisateur

- Cr�er un contact
- Modifier un contact
- Supprimer un contact
- Afficher les d�tails d'un contact
- Rechercher un contact

Le projet utilise composer ainsi que bootstrap
Les classes personnelles se trouvent dans /vendor/MiguelForget/

Le projet se d�coupe en plusieurs parties:
- les vues: fichiers php pr�fix� de 'view'
- model: classe g�rant l'acc�s aux donn�es
- post: fichier php faisant l'interaction entre le model et les vues
(d'autres fichiers sont utilis�s pour �viter les redondances au sein des vues)

Le projet utilise �galement un peu de javascript (javascript.js)
