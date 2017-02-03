<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AdressBook;

/**
 * Description of Validation
 *
 * @author forge
 */
class Validation {

    
    static function validateNom($value) {
        return self::isMatch('#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸ \-\ \'\.]*$#', $value);
    }

    static function validateEmail($value) {
        return self::isMatch('#^([a-zA-Z0-9.-_]+)@([a-zA-Z0-9.-_]+)\.([a-z]{2,4})$#', $value); //Ajouter un # au début et à la fin de la regex
    }

    static function validateTelephone($value) {
        return self::isMatch('#^((\+[0-9]{2})|0)([0-9]{8,9})$#', $value); //Vérifie si le numéro est préfixé d'un +..
    }
    
    static function validateCodePostal($value){
        return self::isMatch('#^[0-9]{4,5}$#', $value);
    }
    
    static function validateNumero($value){
        return self::isMatch('#^[0-9]{1,5}$#', $value); //Il n'est pas possible de mettre un numéro contenant une lettre (la base de données ne le supporte pas)
    }
    
    private static function isMatch($pattern, $subject) {
        if (preg_match($pattern, $subject)) {
            return true;
        } else {
            return false;
        }
    }

}
