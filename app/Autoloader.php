<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 31/03/2016
 * Time: 14:18
 */

class Autoloader {
    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){
        require 'class/' . $class . '.php';
    }

}
