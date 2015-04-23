<?php
# ------------------------------------------------------------------------------------------------ #
# program: database.php
# author:  Rashed Aldubayyan
# course:  cis355 Winter 2015
# purpose: 
# ------------------------------------------------------------------------------------------------ #
# input:   $_POST, or nothing
#
#				  displayHTMLHead
#               
#
# output:  HTML, CSS, JavaScript code 
# --------------------------------------------------------------------------- #


// ---------- set connection variables and verify connection ---------------
class Database
{
    private static $dbName = 'CIS355raldubay' ;
    private static $dbHost = 'localhost' ;
    private static $dbUsername = 'CIS355raldubay';
    private static $dbUserPassword = 'Mohammed4';
     
    private static $cont  = null;
     
    public function __construct() {
        die('Init function is not allowed');
    }
     
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {     
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword); 
        }
        catch(PDOException $e)
        {
          die($e->getMessage()); 
        }
       }
       return self::$cont;
    }
     
    public static function disconnect()
    {
        self::$cont = null;
    }
}
?>