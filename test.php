<?php
namespace AdressBook;

require 'vendor/autoload.php';
use AdressBook\Validation as v;

if (v::Nom("Bertànd")){
    echo 'true';
}
else{
    echo 'false';
}

?>
