Auteur: Miguel FORGET
Date de fin: 04/02/2017
Cours: PHP-ESA

Le projet AdressBook à pour objectif de créer un carnet d'adresse.
Celui-ci utilise une database MySql (créer avec PHPMyAdmin). Les scripts de création des tables se trouvent dans le dossier /Scripts/

Le projet offre les fonctionnalités suivantes:

- Créer un utilisateur (login + password)
- Se connecter avec un utilisateur

- Créer un contact
- Modifier un contact
- Supprimer un contact
- Afficher les détails d'un contact
- Rechercher un contact

Le projet utilise composer ainsi que bootstrap
Les classes personnelles se trouvent dans /vendor/MiguelForget/

Le projet se découpe en plusieurs parties:
- les vues: fichiers php préfixés de 'view'
- model: classe gérant l'accès aux données
- post: fichier php faisant l'interaction entre le model et les vues
(d'autres fichiers sont utilisés pour éviter les redondances au sein des vues)

Le projet utilise également un peu de javascript (javascript.js)
