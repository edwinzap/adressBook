<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AdressBook;

/**
 * Description of Contact
 *
 * @author forge
 */
class Contact {

    private $Id;
    private $IdUtilisateur;
    private $Nom;
    private $Prenom;
    private $Telephone;
    private $Rue;
    private $Numero;
    private $CodePostal;
    private $Ville;

    function __construct() {
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i)) {
            call_user_func_array(array($this, $f), $a);
        }
    }

    function __construct2($nom, $prenom) {
        $this->Nom = $nom;
        $this->Prenom = $prenom;
    }

    function __construct3($nom, $prenom, $telephone) {
        $this->Nom = $nom;
        $this->Prenom = $prenom;
        $this->Telephone = $telephone;
    }

    function __construct7($nom, $prenom, $telephone, $rue, $numero, $codePostal, $ville) {
        $this->Nom = $nom;
        $this->Prenom = $prenom;
        $this->Telephone = $telephone;
        $this->Rue = $rue;
        $this->Numero = $numero;
        $this->CodePostal = $codePostal;
        $this->Ville = $ville;
    }

    function getId() {
        return $this->Id;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function getIdUtilisateur() {
        return $this->IdUtilisateur;
    }

    function setIdUtilisateur($IdUtilisateur) {
        $this->IdUtilisateur = $IdUtilisateur;
    }

    function getNom() {
        return $this->Nom;
    }

    function getPrenom() {
        return $this->Prenom;
    }

    function getTelephone() {
        if (empty($this->Telephone)) {
            return null;
        } else {
            return $this->Telephone;
        }
    }

    function getRue() {
        if (empty($this->Rue)) {
            return null;
        } else {
            return $this->Rue;
        }
    }

    function getNumero() {
        if ($this->Numero==0) {
            return null;
        } else {
            return $this->Numero;
        }
    }

    function getCodePostal() {
        if ($this->CodePostal==0) {
            return null;
        } else {
            return $this->CodePostal;
        }
    }

    function getVille() {
        if (empty($this->Ville)) {
            return null;
        } else {
            return $this->Ville;
        }
    }

    function setNom($Nom) {
        $this->Nom = $Nom;
    }

    function setPrenom($Prenom) {
        $this->Prenom = $Prenom;
    }

    function setTelephone($Telephone) {
        $this->Telephone = $Telephone;
    }

    function setRue($Rue) {
        $this->Rue = $Rue;
    }

    function setNumero($Numero) {
        $this->Numero = $Numero;
    }

    function setCodePostal($CodePostal) {
        $this->CodePostal = $CodePostal;
    }

    function setVille($Ville) {
        $this->Ville = $Ville;
    }

    public function PrintDetails() {
        return $text = $this->Prenom . " " . strtoupper($this->Nom);
    }

    public function PrintFullDetails() {
        return "Id: " . $this->Id .
                "<br>IdUtilisateur: " . $this->IdUtilisateur .
                "<br>Nom: " . $this->Nom .
                "<br>Prenom: " . $this->Prenom .
                "<br>Telephone: " . $this->Telephone .
                "<br>Rue: " . $this->Rue .
                "<br>Numero: " . $this->Numero .
                "<br>CodePostal: " . $this->CodePostal .
                "<br>Ville: " . $this->Ville;
    }
    public function PrintAllDetails(){
        $text=  "<p><strong>".ucfirst($this->Prenom) . " " .strtoupper($this->Nom). "</strong></p>".
                "<p>". $this->Telephone . "</p>";
        if($this->getVille()!=null || $this->getRue()!=null ||$this->getNumero()!=null ||$this->CodePostal!=null){
            $text = $text . "<h3>Adresse</h3>". $this->PrintAdresse();
        }
        return $text;
                
    }
    public function PrintAdresse(){
        return "<p>". ucfirst($this->getRue()). ", " . $this->getNumero() ."</p>".
                "<p>". $this->getCodePostal() ." ". $this->getVille()."</p>"; 
    }

}
