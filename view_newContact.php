<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
session_start();
require 'errorContact.php';

if(!isset($_SESSION['utilisateur'])){
    header('Location: index.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link href="vendor/twbs/bootstrap/dist/css/bootstrap.css" rel="stylesheet"/>
        <title>Carnet d'adresses</title>
        <style>
            .container{
                max-width: 750px;
            }
        </style>
        <script type="text/javascript" src="javascript.js"></script>
    </head>
    <body class="bg-primary" onload="SetFocus('nom')">
        <?php include 'title.html'; ?>
        <div class="panel panel-default container">
            <h2 class="panel-heading text-center">Nouveau contact</h2>
            <form method="post" action="post.php" class="panel-body  text-info">
                <?php include 'contactForm.php' ?>
                <div class="btn-toolbar pull-right">
                    <a class="btn btn-primary" href="view_listeContact.php">Annuler</a>
                    <input type="submit" class="btn btn-primary" name="view_newContact" value="Ajouter le contact"/>
                </div>
            </form>   
        </div>
    </body>
</html>
