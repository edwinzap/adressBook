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
        <h1 class="page-header text-center">Carnet d'adresses</h1>
        <div class="panel panel-default container">
            <h2 class="panel-heading text-center">Inscription</h2>
            <form action="post.php" method="post" onSubmit="return validate();" class="panel-body">
                <div class="form-group">
                    <input type="text" name="login" placeholder="Login" class="form-control" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="password" id="password" placeholder="Mot de passe" class="form-control" required/>
                </div>
                <div class="form-group">
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmation du mot de passe" class="form-control" required/>
                </div>
                <input type="submit" class="btn btn-primary pull-right" name="view_signIn" value="S'inscrire"/>
                <p class="pull-left" id="message"></p>    
            </form>   
        </div>
    </body>
</html>
</div>