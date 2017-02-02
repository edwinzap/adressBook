<?php //

namespace AdressBook;

require 'vendor/autoload.php';
session_start();
unset($_SESSION['post_login']);
unset($_SESSION['success_login']);
//var_dump($_POST);
//var_dump($_SESSION);

use AdressBook\Model as model;
use AdressBook\Validation as v;
//-----Vérifie de quel page provient le $_POST-----
//View_SignIn
if (!empty($_POST['view_signIn'])) {

    echo 'Sign_In';
    if (SignIn() == true) {
        header('Location: view_login.php');
    } else {
        header('Location: view_signIn.php');
    }
}
//View_Login
elseif (!empty($_POST['view_login'])) {

    echo 'Login';
    if (LogIn() == True) {
        header('Location: view_listeContact.php');
    } else {
        header('Location: view_login.php');
    }
}
//View_ListeContact
elseif (!empty($_POST['view_listeContact'])) {
    echo 'ListeContact';
    RechercheContact();
    header('Location: view_listeContact.php');
}
//View_Contact
elseif (!empty($_POST['view_newContact'])) {
    echo 'Add_Contact';

    if (AddContact()) {
        header('Location: view_listeContact.php');
    } else {
        header('Location: view_newContact.php');
    }
}

//-----Functions-----
function LogIn() {

    $user = new Utilisateur($_POST['login'], $_POST['password']);
    $_SESSION['utilisateur'] = $user;

    $valide = model::ValidateLogin($user);

    if ($valide == TRUE) {
        echo 'Identification réussie';
        $_SESSION['success_login']=true;
        return true;
    } else {
        echo 'Login ou mot de passe incorrect';
        $_SESSION['success_login']=false;
        $_SESSION['post_login']=$user->getLogin();
        return false;
    }
}

function SignIn() {
    $pass1 = $_POST['password'];
    $pass2 = $_POST['confirm_password'];
    $login = $_POST['login'];

    if (!empty($login) && !empty($pass1) && !empty($pass2)) {
        if ($pass1 == $pass2) {
            return model::AddUtilisateur(new Utilisateur($login, $pass1));
        }
    } else {
        return false;
    }
}

function RechercheContact() {
    if (isset($_POST['recherche']) && isset($_SESSION['utilisateur'])) {
        if (!empty($_POST['recherche'])) {
            $_SESSION['recherche'] = $value = $_POST['recherche'];
            $id = $_SESSION['utilisateur']->getId();
            $_SESSION['listeContact'] = Model::GetContactWhere($id, $value);
        } else {
            unset($_SESSION['listeContact']);
            unset($_SESSION['recherche']);
        }
    }
}

function AddContact() {
    if (ValidateContact()) {
        $contact = new Contact($_POST['nom'], $_POST['prenom'], $_POST['telephone'], $_POST['rue'], $_POST['numero'], $_POST['codePostal'], $_POST['ville']);
        $contact->setIdUtilisateur($_SESSION['utilisateur']->GetId());
        Model::AddContact($contact);
        unset($_SESSION['post_contact']);
        return true;
    } else {
        return false;
    }
}

function ValidateContact() {
    $_SESSION['success_contact'] = array("nom" => false, "prenom" => false, "telephone" => false, "rue" => false, "numero" => false, "codePostal" => false, "ville" => false);
    $s = $_SESSION['success_contact'];
    $_SESSION['post_contact'] = $_POST;

    if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['telephone']) && isset($_POST['rue']) && isset($_POST['numero']) && isset($_POST['codePostal']) && isset($_POST['ville'])) {
        if (!empty($_POST['nom']) && v::Nom($_POST['nom'])) {
            $s['nom'] = true;
        }
        if (!empty($_POST['prenom']) && v::Nom($_POST['prenom'])) {
            $s['prenom'] = true;
        }
        if (empty($_POST['telephone']) || v::Telephone($_POST['telephone'])) {
            $s['telephone'] = true;
        }
        if (empty($_POST['rue']) || v::Nom($_POST['rue'])) {
            $s['rue'] = true;
        }
        if (empty($_POST['numero']) || v::Numero($_POST['numero'])) {
            $s['numero'] = true;
        }
        if (empty($_POST['codePostal']) || v::CodePostal($_POST['codePostal'])) {
            $s['codePostal'] = true;
        }
        if (empty($_POST['ville']) || v::Nom($_POST['ville'])) {
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