<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
session_start();
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
    <body class="bg-primary">
        <?php include 'title.html'; ?>
        <div class="panel panel-default container text-primary">
            <h2 class="panel-heading text-center">Details du contact</h2>
            <div class="panel-body">
                <?php
                $contacts = array_filter(
                        $_SESSION['listeContact'], function ($e) {
                    return $e->GetId() == $_GET['idContact'];
                }
                );
                $contact = array_shift($contacts);
                echo $contact->PrintAllDetails();
                ?>
                <a href="view_listeContact.php" class="btn btn-primary pull-right">Annuler</a>    
            </div>
        </div>
    </body>
</html>