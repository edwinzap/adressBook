<?php

/**
 * Description of model:
 * Contiens toutes les functions nécessaires à la manipulation des données
 * @author forge
 */

namespace AdressBook;

use PDO;
use AdressBook\Contact;

require 'vendor/autoload.php';

class Model {

    const CONNECTION_STRING = 'mysql:host=localhost;dbname=adressbook';
    const USER = 'miguel';
    const PASSWORD = 'test123';

    private static function GetUtilisateur($utilisateur) {
        try {
            //$pdo = new PDO(self::CONNECTION_STRING,self::USER,self::PASSWORD);    
            $pdo = new PDO(self::CONNECTION_STRING, 'root');
            $sql = "SELECT * FROM utilisateur WHERE login=:login LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $utilisateur->getLogin());
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    static function ValidateLogin($utilisateur) {
        try {
            $stmt = self::GetUtilisateur($utilisateur);
            $r = $stmt->fetchObject();

            if ($stmt->rowCount() > 0 && password_verify($utilisateur->getPassword(), $r->password)) {
                $utilisateur->setValide(true);
                $utilisateur->setId($r->id);
                return true;
            } else {
                $utilisateur->setValide(false);
                $utilisateur->setId(-1);
                return false;
            }
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    static function UtilisateurExists($utilisateur) {
        try {
            $count = self::GetUtilisateur($utilisateur)->rowCount();

            if ($count > 0) {
                return true;
            } else
                return false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    static function AddUtilisateur($utilisateur) {

        if (self::UtilisateurExists($utilisateur) == false) {

            $pdo = new PDO(self::CONNECTION_STRING, 'root');
            $sql = "INSERT INTO Utilisateur(login, password) VALUES (:login,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $utilisateur->getLogin());
            $stmt->bindParam(':password', password_hash($utilisateur->getPassword(), PASSWORD_DEFAULT));
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    static function GetContactWhere($id, $value) {
        try {
            $value = $value . "%"; //Pourcentage ne doit pas être mis dans la requête => erreur !
            //$pdo = new PDO(self::CONNECTION_STRING,self::USER,self::PASSWORD);    
            $pdo = new PDO(self::CONNECTION_STRING, 'root');
            $sql = "SELECT * FROM contact WHERE id_utilisateur=:id_utilisateur AND Nom LIKE :value OR Prenom LIKE :value";
            //$sql = "SELECT * FROM contact WHERE id_utilisateur=:id_utilisateur";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_utilisateur', $id);
            $stmt->bindParam(':value', $value);
            $stmt->execute();

            $listeContacts = array();
            while ($row = $stmt->fetchObject()) {
                $contact = new Contact($row->nom, $row->prenom, $row->telephone, $row->rue, $row->numero, $row->codePostal, $row->ville);
                $contact->setId($row->id);
                $contact->setIdUtilisateur($row->id_utilisateur);
                array_push($listeContacts, $contact);
            }
            return $listeContacts;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    static function AddContact($contact) {
        try {
            $pdo = new PDO(self::CONNECTION_STRING, 'root');
            $sql = "INSERT INTO Contact(nom,prenom,telephone,rue,numero,codePostal,ville, id_utilisateur) VALUES (:nom,:prenom,:telephone,:rue,:numero,:codePostal,:ville,:id_utilisateur)";
            $stmt = $pdo->prepare($sql);
            
            $stmt->bindParam(':nom', $contact->getNom());
            $stmt->bindParam(':prenom', $contact->getPrenom());
            $stmt->bindParam(':telephone',$contact->getTelephone());
            $stmt->bindParam(':rue', $contact->getRue());
            $stmt->bindParam(':numero', $contact->getNumero());
            $stmt->bindParam(':codePostal', $contact->getCodePostal());
            $stmt->bindParam(':ville', $contact->getVille());
            $stmt->bindParam(':id_utilisateur', $contact->getIdUtilisateur());
            
            $stmt->execute();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
