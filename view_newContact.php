<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
session_start();

if (isset($_SESSION['post_contact'])) {
    $s = $_SESSION['post_contact'];
    
    $nom = $s['nom'];
    $prenom = $s['prenom'];
    $telephone = $s['telephone'];
    $rue = $s['rue'];
    $numero = $s['numero'];
    $codePostal = $s['codePostal'];
    $ville = $s['ville'];
}
else{
        $nom = $prenom = $telephone = $rue = $numero = $codePostal = $ville = "";
}

if (isset($_SESSION['success_contact'])){
    $s = $_SESSION['success_contact'];

    $successNom = $s['nom'];
    $successPrenom = $s['prenom'];
    $successTelephone = $s['telephone'];
    $successRue = $s['rue'];
    $successNumero = $s['numero'];
    $successCodePostal = $s['codePostal'];
    $successVille = $s['ville'];
        
}
else{
    $successNom = $successPrenom = $successTelephone = $successRue = $successNumero =  $successCodePostal = $successVille = true;   
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
    </head>
    <body class="bg-primary">
     <?php include 'title.html'; ?>
        <div class="panel panel-default container">
            <h2 class="panel-heading text-center">Nouveau contact</h2>
            <form method="post" action="post.php" class="panel-body  text-info">
                <div class="form-group  <?php if($successNom == false){echo 'has-error';}?>">
                    <label for="nom" class="control-label">Nom</label>
                    <input type="text" placeholder="Nom" name="nom" class="form-control" value="<?php echo $nom ?>" required/>
                </div>
                <div class="form-group  <?php if($successPrenom == false){echo 'has-error';}?>">
                    <label for="prenom" class="control-label">Prénom</label>
                    <input type="text" placeholder="Prénom" name="prenom" class="form-control" value="<?php echo $prenom ?>" required/>
                </div>
                <div class="form-group  <?php if($successTelephone == false){echo 'has-error';}?>">
                    <label for="telephone" class="control-label">Téléphone</label>
                    <input type="text" placeholder="Téléphone" name="telephone" value="<?php echo $telephone ?>"  class="form-control"/>
                </div>
                <fieldset class="fieldset">
                    <legend>Adresse</legend>
                    <div class="row">
                        <div class="col-sm-6 form-group <?php if($successRue == false){echo 'has-error';}?>">
                            <label for="rue" class="control-label">Rue</label>
                            <input type="text" placeholder="Rue" name="rue" value="<?php echo $rue ?>" class="form-control"/>
                        </div>
                        <div class="col-sm-6 form-group <?php if($successNumero == false){echo 'has-error';}?>">
                            <label for="numero" class="control-label">Numéro</label>
                            <input type="number" placeholder="Numéro" name="numero" value="<?php echo $numero ?>" class="form-control"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group <?php if($successCodePostal == false){echo 'has-error';}?>">
                            <label for="codePostal" class="control-label">Code Postal</label>
                            <input type="number" placeholder="Code Postal" name="codePostal" value="<?php echo $codePostal ?>" class="form-control"/>
                        </div>
                        <div class="col-sm-6 form-group <?php if($successVille == false){echo 'has-error';}?>">
                            <label for="ville" class="control-label">Ville</label>
                            <input type="text" placeholder="Ville" name="ville" value="<?php echo $ville ?>" class="form-control"/>
                        </div>
                    </div>
                </fieldset>
                <div class="btn-toolbar pull-right">
                    <a class="btn btn-primary" href="view_listeContact.php">Annuler</a>
                    <input type="submit" class="btn btn-primary" name="view_newContact" value="Ajouter le contact"/>
                </div>
            </form>   
        </div>
    </body>
</html>
