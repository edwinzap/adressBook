<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AdressBook;

/**
 * Description of Utilisateur
 * Utilisateur utilisé pour se connecter à son carnet d'adresses
 * @author forge
 */
class Utilisateur {
//Hasher le password dans la classe ?
    
    private $Id = -1;
    private $Valide = false;
    private $Login;
    private $Password;

    public function __construct($login, $password) {
        $this->Login = $login;
        $this->Password = $password;
    }

    function getId() {
        return $this->Id;
    }

    function getValide() {
        return $this->Valide;
    }

    function getLogin() {
        return $this->Login;
    }

    function getPassword() {
        return $this->Password;
    }

    function setId($Id) {
        $this->Id = $Id;
    }

    function setValide($Valide) {
        $this->Valide = $Valide;
    }

    function setLogin($Login) {
        $this->Login = $Login;
    }

    function setPassword($Password) {
        $this->Password = $Password;
    }

}
