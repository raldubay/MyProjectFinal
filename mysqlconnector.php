<?php
define("DB_SERVER", "localhost");
define("DB_NAME", "CIS355raldubay");
define("DB_USER", "CIS355raldubay");
define("DB_PASSWORD", "Mohammed4");

class DBConnector {

    public static function get_db_connection() {
        $mysqli  = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);
        if ($mysqli->connect_error) {
            //Figure out how to throw proper exception
            die("Connection failed: " . mysqli_connect_error());
        }
        else {
            return $mysqli;
        }
    }

}

?>