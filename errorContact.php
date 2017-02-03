<?php
if (isset($_SESSION['post_contact'])) {
    $s = $_SESSION['post_contact'];
    if (isset($s['id'])){
        $id=$s['id'];
    }
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

