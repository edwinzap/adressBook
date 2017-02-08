<?php

//

namespace AdressBook;

require 'vendor/autoload.php';
session_start();
unset($_SESSION['post_login']);
unset($_SESSION['success_login']);
unset($_SESSION['post_contact']);
unset($_SESSION['success_contact']);
unset($_SESSION['recherche']);
//unset($_SESSION['listeContact']);

//var_dump($_POST);
//var_dump($_SESSION);

use AdressBook\Model as model;
use AdressBook\Validation as v;

//-----Vérifie de quel page provient le $_POST-----
//View_SignIn
if (isset($_POST['view_signIn'])) {

    echo 'Sign_In';
    if (signIn() == true) {
        header('Location: view_login.php');
    } else {
        $_SESSION['success_signIn']=false;
        $_SESSION['post_signIn']= $_POST['login'];
        header('Location: view_signIn.php');
    }
    
}
//View_Login
elseif (isset($_POST['view_login'])) {

    echo 'Login';
    if (logIn() == True) {
        header('Location: view_listeContact.php');
    } else {
		unset($_SESSION['utilisateur']);
        header('Location: view_login.php');
    }
}
//View_ListeContact
elseif (isset($_POST['view_listeContact'])) {
    echo 'ListeContact';
    rechercheContact();
    header('Location: view_listeContact.php');
}
//View_NewContact
elseif (isset($_POST['view_newContact'])) {
    echo 'Add_Contact';
     
    if (addContact()) {
        header('Location: view_listeContact.php');
    } else {
        header('Location: view_newContact.php');
    }
}

//View_ContactDetails
//Modifier
elseif (isset($_POST['view_contactDetailModifier'])) {
    echo 'ContactModifier';
    if (isset($_SESSION['current_contact'])) {
        $contact = $_SESSION['current_contact'];
        $s = array();
        $s['id'] = $contact->getId();
        $s['nom'] = $contact->getNom();
        $s['prenom'] = $contact->getPrenom();
        $s['telephone'] = $contact->getTelephone();
        $s['rue'] = $contact->getRue();
        $s['numero'] = $contact->getNumero();
        $s['codePostal'] = $contact->getCodePostal();
        $s['ville'] = $contact->getVille();

        $_SESSION['post_contact'] = $s;
        header('Location: view_updateContact.php');
    }
}
//Supprimer
elseif (isset($_POST['view_contactDetailSupprimer'])) {
    echo 'ContactSupprimer';
    if (isset($_SESSION['current_contact'])) {
        $contact = $_SESSION['current_contact'];
        model::removeContact($contact);
        unset($_SESSION['recherche']);
        unset($_SESSION['listeContact']);
        header('Location: view_listeContact.php');
    }
}

//View_UpdateContact
elseif (isset($_POST['view_updateContact'])) {
    echo 'UpdateContact';
    if (updateContact()) {
        header('Location: view_contactDetails.php?idContact=' . $_POST['id']);
    } else {
        header('Location: view_updateContact.php');
    }
}

//-----Functions-----
function logIn() {

    $user = new Utilisateur($_POST['login'], $_POST['password']);
    $_SESSION['utilisateur'] = $user;

    $valide = model::validateLogin($user);

    if ($valide == TRUE) {
        echo 'Identification réussie';
        $_SESSION['success_login'] = true;
        return true;
    } else {
        echo 'Login ou mot de passe incorrect';
        $_SESSION['success_login'] = false;
        $_SESSION['post_login'] = $user->getLogin();
        return false;
    }
}

function signIn() {
    $pass1 = $_POST['password'];
    $pass2 = $_POST['confirm_password'];
    $login = $_POST['login'];
    var_dump($_POST);
    if (!empty($login) && !empty($pass1) && !empty($pass2)) {
        if ($pass1 == $pass2) {
            return model::addUtilisateur(new Utilisateur($login, $pass1));
        }
    } else {
        return false;
    }
}

function rechercheContact() {
    if (isset($_POST['recherche']) && isset($_SESSION['utilisateur'])) {
        if (!empty($_POST['recherche'])) {
            $_SESSION['recherche'] = $value = $_POST['recherche'];
            $id = $_SESSION['utilisateur']->getId();
            $_SESSION['listeContact'] = Model::getContactWhere($id, $value);
        } else {
            unset($_SESSION['listeContact']);
            unset($_SESSION['recherche']);
        }
    }
}

function addContact() {
    
    if (validateContact()) {
        $contact = new Contact($_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['rue'], $_POST['numero'], $_POST['codePostal'], $_POST['ville']);
        $contact->setIdUtilisateur($_SESSION['utilisateur']->getId());
        Model::addContact($contact);
        unset($_SESSION['post_contact']);
        return true;
    } else {
        return false;
    }
}

function updateContact() {
    if (validateContact()) {
        $contact = new Contact($_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['rue'], $_POST['numero'], $_POST['codePostal'], $_POST['ville']);
        $contact->setId($_POST['id']);

        model::updateContact($contact);
        unset($_SESSION['post_contact']);
        return true;
    } else {
        return false;
    }
}

function validateContact() {
    $_SESSION['success_contact'] = array("nom" => false, "prenom" => false, "telephone" => false, "rue" => false, "numero" => false, "codePostal" => false, "ville" => false);//initialise les valeurs du tableau à false
    $s = $_SESSION['success_contact'];
    $_POST['telephone'] = preg_replace('#[\/. \-]#', '',$_POST['telephone']); //Retire tous les caractères spéciaux du numéro de téléphone
    $_SESSION['post_contact'] = $_POST;
    
    echo $_POST['telephone'];

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['rue']) && isset($_POST['numero']) && isset($_POST['codePostal']) && isset($_POST['ville'])) {
        if (!empty($_POST['nom']) && v::validateNom($_POST['nom'])) {
            $s['nom'] = true;
        }
        if (!empty($_POST['prenom']) && v::validateNom($_POST['prenom'])) {
            $s['prenom'] = true;
        }
        if (empty($_POST['telephone']) || v::validateTelephone($_POST['telephone'])) {
            $s['telephone'] = true;
        }
        if (empty($_POST['rue']) || v::validateNom($_POST['rue'])) {
            $s['rue'] = true;
        }
        if (empty($_POST['numero']) || v::validateNumero($_POST['numero'])) {
            $s['numero'] = true;
        }
        if (empty($_POST['codePostal']) || v::validateCodePostal($_POST['codePostal'])) {
            $s['codePostal'] = true;
        }
        if (empty($_POST['ville']) || v::validateNom($_POST['ville'])) {
            $s['ville'] = true;
        }
        $_SESSION['success_contact'] = $s; //Bizarre ! L'objet $s semble être un clone plutot que le même objet !
        //Vérifie qu'aucune valeur ne soit invalide
        if (in_array(false, $s)) {
            return false;
        } else {
            return true;
        }
    }
}

?>