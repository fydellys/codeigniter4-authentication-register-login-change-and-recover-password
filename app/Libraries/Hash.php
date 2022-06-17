<?php 

namespace App\Libraries;

class Hash 
{
    public static function makePassword($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    public static function checkPassword($password,$db_password){
        if (password_verify($password,$db_password)) {
            return true;
        } else {
            return false;
        }
    }
}