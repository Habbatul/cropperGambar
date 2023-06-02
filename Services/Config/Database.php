<?php

namespace Config {

    class Database
    {

        static function getConnection(): \PDO
        {
            //lakukan penyesuaian
            $host = "localhost";
            $database = "jayadigital";
            $username = "root";
            $password = "";
            
            return new \PDO("mysql:host=$host;dbname=$database", $username, $password);
        }

    }

}
