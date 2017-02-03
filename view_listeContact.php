<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
session_start();
unset($_SESSION['post_contact']);
unset($_SESSION['success_contact']);
unset($_SESSION['success_login']);

if(!isset($_SESSION['utilisateur'])){
    header('Location: index.php');
}

if(!isset($_SESSION['recherche']) || empty($_SESSION['recherche']))
{
    unset($_SESSION['listeContact']);
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
    <body class="bg-primary" onload="SetFocus('recherche')" onkeypress="return GetBackSpace(event)">
        
   <?php include 'title.html'; ?>
        
        <div class="panel panel-default container text-primary">
            <h2 class="panel-heading text-center">Recherche de contacts</h2>
        
            <form method="post" action="post.php" class="panel-body form-horizontal">
                <div class="form-group">
                    <input type="text" name="recherche" id="recherche" placeholder="Recherche" class="form-control" oninput="Submit()" value="<?php
                    if (isset($_SESSION['recherche'])) {
                        echo ltrim($_SESSION['recherche']);
                    }
                    ?>"/>
                    <input type="text" hidden name="view_listeContact" value="listeContact"/>
                </div>
            </form> 
            
            <div class="panel-body">
                
                    <?php if (isset($_SESSION['listeContact'])){ 
                        echo '<p>Nombre de contacts trouvés: <strong>' . count($_SESSION['listeContact']) . '</strong></p>';
                        echo '<ul>'; 
                        foreach ($_SESSION['listeContact'] as $contact) {
                            echo '<li><a href="view_contactDetails.php?idContact=' . $contact->getId() . '">' . $contact->printDetails() . '</a></li>';
                        }
                        echo '</ul>';
                    }
                    ?>
                <a class="btn btn-primary pull-right" href="view_newContact.php">Nouveau contact</a>
            </div>
        </div>
    </body>
</html>