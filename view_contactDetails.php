<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
session_start();

if(!isset($_SESSION['utilisateur'])){
    header('Location: index.php');
}
if(isset($_GET['idContact']))
{
    $contact = $_SESSION['current_contact']  = AdressBook\Model::getContact($_GET['idContact']);
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
    <body class="bg-primary">
        <?php include 'title.html'; ?>
        <div class="panel panel-default container text-primary">
            <h2 class="panel-heading text-center">Details du contact</h2>
            <div class="panel-body">
                <?php if(isset($_GET['idContact'])){echo $contact->printAllDetails();}else{echo 'Erreur: aucun Id trouvé !';} ?>
                <div class="row" style="margin-top:30px;">
                    <form action="post.php" method="post" class="form">
                        <div class="form-group" style="margin:0">
                            <input type="submit" name="view_contactDetailModifier" value="Modifier" class="btn btn-primary"/>
                            <input type="submit" name="view_contactDetailSupprimer" value="Supprimer" class="btn btn-primary"/>
                            <a href="view_listeContact.php" class="btn btn-primary pull-right">Annuler</a>  
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>