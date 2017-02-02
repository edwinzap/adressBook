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

    
    static function Nom($value) {
        return self::IsMatch('#^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸ \-\ \']*$#', $value);
    }

    static function Email($value) {
        return self::IsMatch('#^([a-zA-Z0-9.-_]+)@([a-zA-Z0-9.-_]+)\.([a-z]{2,4})$#', $value); //Ajouter un # au début et à la fin de la regex
    }

    static function Telephone($value) {
        return self::IsMatch('#^((\+[0-9]{2})|0)([0-9]{8,9})$#', $value); //Vérifie si le numéro est préfixé d'un +..
    }
    
    static function CodePostal($value){
        return self::IsMatch('#^[0-9]{4,5}$#', $value);
    }
    
    static function Numero($value){
        return self::IsMatch('#^[0-9]{1,5}$#', $value); //Il n'est pas possible de mettre un numéro contenant une lettre (la base de données ne le supporte pas)
    }
    
    private static function IsMatch($pattern, $subject) {
        if (preg_match($pattern, $subject)) {
            return true;
        } else {
            return false;
        }
    }

}
