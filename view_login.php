<!DOCTYPE html>
<?php
require 'vendor/autoload.php';
session_start();

if(!isset($_SESSION['utilisateur'])){
    header('Location: index.php');
}

unset($_SESSION['success_signIn']);
if(isset($_SESSION['utilisateur'])){
    header('Location: view_listeContact.php');
}

$login="";
if (isset($_SESSION['success_login'])) {
    if ($_SESSION['success_login'] == false) {
        $success = false;
        if (isset($_SESSION['post_login'])) {
            $login=$_SESSION['post_login'];
        }
    } else {
        $success = true;
    }
} else {
    $success = true;
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
        <h1 class="page-header text-center">Carnet d'adresses</h1>
        <div class="panel panel-default container text-info">
            <h2 class="panel-heading text-center">Identification</h2>
            
            <form method="post" action="post.php" class="panel-body">
                <div class="form-group <?php if($success == false){echo 'has-error';}?>">
                    <label for="login" class="control-label">Login</label>
                    <input type="text" name="login" placeholder="Login" class="form-control" value="<?php echo $login; ?>" required/>
                </div>
                <div class="form-group <?php if($success == false){echo 'has-error';}?>">
                    <label for="password" class="control-label">Mot de passe</label>
                    <input type="password" name="password" placeholder="Mot de passe" class="form-control" required/>
                </div>
                <?php if($success == false){echo '<p class="text-danger"><strong>Login ou mot de passe incorrecte !</strong></p>';}?>
                <a href="view_signIn.php">S'inscrire</a>
                <input type="submit" class="btn btn-primary pull-right" name="view_login" value="Se connecter"/>
            </form>   
        </div>
    </body>
</html>