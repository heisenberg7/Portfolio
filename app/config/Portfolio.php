<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02/06/2016
 * Time: 15:54
 */

namespace config;

class Portfolio {
    const DBDSN = 'mysql:host=localhost;dbname=portfolio';
    const DBUSER = 'root';
    const DBMDP = '';
    /*const NBPERPAGEPRODUCT = 9;
    const NBPERPAGEEVENT = 12;
    const NBPERPAGEFEATURED = 9;*/
    const KEYHASH = "fg,dhfjkgsd456ùm(*^(;";

    Public function encryptionPWD($pwd) {
        return hash('sha512',$pwd.Portfolio::KEYHASH);
    }
}