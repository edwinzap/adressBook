<!DOCTYPE html>

<?php
require 'vendor/autoload.php';
session_start();

$login="";
if (isset($_SESSION['success_signIn'])){
    if($_SESSION['success_signIn']==false){
        $error = 'Cet utilisateur existe déjà !';
        if (isset($_SESSION['post_signIn'])){
            $login = $_SESSION['post_signIn'];
        }
}
}else{
    $error="";
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
        <h1 class="page-header text-center">Carnet d'adresses</h1>
        <div class="panel panel-default container">
            <h2 class="panel-heading text-center">Inscription</h2>
            <form action="post.php" method="post" onSubmit="return validate();" class="panel-body text-info">
                <div class="form-group">
                    <label for="login" class="control-label">Login</label>
                    <input type="text" name="login" placeholder="Login" class="form-control" required value="<?php echo $login; ?>"/>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Mot de passe</label>
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control" required/>
                </div>
                <div class="form-group">
                    <label for="confirm_password" class="control-label">Confirmation du mot de passe</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmation du mot de passe" class="form-control" required/>
                </div>
                <div class="btn-toolbar pull-right">
                    <a class="btn btn-primary" href="view_login.php">Annuler</a>
                    <input type="submit" class="btn btn-primary pull-right" name="view_signIn" value="S'inscrire"/>
                </div>
                <p class="pull-left text-danger" id="message"><strong><?php echo $error; ?></strong></p>    
            </form>   
        </div>
    </body>
</html>