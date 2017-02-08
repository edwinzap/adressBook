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

    const CONNECTION_STRING = 'mysql:host=mysql1.paris1.alwaysdata.com;dbname=edwinzap_adressbook';
    const USER = 'edwinzap_miguel';
    const PASSWORD = 'test123';

    private static function getUtilisateur($utilisateur) {
        try {
            $pdo = new PDO(self::CONNECTION_STRING, self::USER, self::PASSWORD);
            $sql = "SELECT * FROM utilisateur WHERE login=:login LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $utilisateur->getLogin());
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

    static function validateLogin($utilisateur) {
        try {
            $stmt = self::getUtilisateur($utilisateur);
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

    static function utilisateurExists($utilisateur) {
        try {
            $count = self::getUtilisateur($utilisateur)->rowCount();

            if ($count > 0) {
                return true;
            } else
                return false;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
			return false;
        }
    }

    static function addUtilisateur($utilisateur) {
try{
        if (self::utilisateurExists($utilisateur) == false) {

            $pdo = new PDO(self::CONNECTION_STRING,self::USER, self::PASSWORD);    
            $sql = "INSERT INTO utilisateur(login, password) VALUES (:login,:password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':login', $utilisateur->getLogin());
            $stmt->bindParam(':password', password_hash($utilisateur->getPassword(), PASSWORD_DEFAULT));
			var_dump($pdo);
			if (!$stmt) {
   echo "\nPDO::errorInfo():\n";
   print_r($dbh->errorInfo());
}else
{
	        $stmt->execute();
			echo 'ok';
}

    
            return true;
        } else {
            return false;
        }
}
catch (Exception $ex){
	echo $ex->getMessage();
	return false;
}
    }

    static function getContactWhere($idUtilisateur, $value) {
        try {
            $value = $value . "%"; //Pourcentage ne doit pas être mis dans la requête => erreur !
            $pdo = new PDO(self::CONNECTION_STRING, self::USER, self::PASSWORD);
            $sql = "SELECT * FROM contact WHERE id_utilisateur=:id_utilisateur AND Nom LIKE :value OR Prenom LIKE :value ORDER BY Prenom";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_utilisateur', $idUtilisateur);
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

    static function addContact($contact) {
        try {
            $pdo = new PDO(self::CONNECTION_STRING, self::USER, self::PASSWORD);
            $sql = "INSERT INTO contact(nom, prenom,telephone,rue,numero,codePostal,ville, id_utilisateur) VALUES (:nom,:prenom,:telephone,:rue,:numero,:codePostal,:ville,:id_utilisateur)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(':nom', $contact->getNom());
            $stmt->bindParam(':prenom', $contact->getPrenom());
            $stmt->bindParam(':telephone', $contact->getTelephone());
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

    static function removeContact($contact) {
        try {
            
            $pdo = new PDO(self::CONNECTION_STRING, self::USER, self::PASSWORD);
            $sql = "DELETE FROM contact WHERE id=:contactId";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":contactId", $contact->GetId());
            $stmt->execute();
            echo 'remove !';
            
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
    
    static function updateContact($contact){
        try {
            $pdo = new PDO(self::CONNECTION_STRING, self::USER, self::PASSWORD);
            $sql = "UPDATE contact SET nom=:nom, prenom=:prenom,telephone=:telephone,rue=:rue,numero=:numero,codePostal=:codePostal,ville=:ville WHERE id=:id";
            $stmt = $pdo->prepare($sql);

            $stmt->bindParam(":id", $contact->getId());
            $stmt->bindParam(':nom', $contact->getNom());
            $stmt->bindParam(':prenom', $contact->getPrenom());
            $stmt->bindParam(':telephone', $contact->getTelephone());
            $stmt->bindParam(':rue', $contact->getRue());
            $stmt->bindParam(':numero', $contact->getNumero());
            $stmt->bindParam(':codePostal', $contact->getCodePostal());
            $stmt->bindParam(':ville', $contact->getVille());

            $stmt->execute();
            
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }

    }
    
    static function getContact($id){
         try {
            $pdo = new PDO(self::CONNECTION_STRING, self::USER, self::PASSWORD);
            $sql = "SELECT * FROM contact WHERE id=:id LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            
            $row= $stmt->fetchObject();
            if($row!=null){
                $contact = new Contact($row->nom, $row->prenom, $row->telephone, $row->rue, $row->numero, $row->codePostal, $row->ville);
            $contact->setId($row->id);
            $contact->setIdUtilisateur($row->id_utilisateur);
            
            return $contact;
            }
                
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

}
