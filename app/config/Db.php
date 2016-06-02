<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02/06/2016
 * Time: 15:46
 */

/*
try
{
    $db = new PDO('mysql:host=localhost;dbname=portfolio;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
?>
*/

namespace app;

/**
 * Class Db
 * @package app
 */
class Db
{
    /** @var \PDO */
    private $PDOInstance = null;

    /** @var Db */
    private static $instance = null;

    /**
     * Construct
     */
    private function __construct()
    {
        try
        {
            $this->PDOInstance =  new \PDO('mysql:host=localhost;dbname=portfolio', 'root', '', array(
                \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            return $this->PDOInstance;
        }
        catch (\Exception $e)
        {
            die('Erreur : ' . $e->getMessage());
        }
    }

    /**
     * Get an adapter instance
     * Singleton pattern implementation
     * @return Db
     */
    public static function getInstance()
    {
        if(is_null(self::$instance)) {
            self::$instance = new Db();
        }

        return self::$instance;
    }

    /**
     * Clone
     * Police do not cross
     * @throws \LogicException
     */
    public function __clone()
    {
        throw new \LogicException('Clone detected, aborting right here');
    }

    /**
     * Sleep
     * Police do not cross
     * @throws \LogicException
     */
    public function __sleep()
    {
        throw new \LogicException('Serialization detected, aborting right here');
    }

    /**
     * @return \PDO
     */
    public function getPDOInstance()
    {
        return $this->PDOInstance;
    }

    /**
     * @param \PDO $PDOInstance
     */
    public function setPDOInstance($PDOInstance)
    {
        $this->PDOInstance = $PDOInstance;
    }
}

