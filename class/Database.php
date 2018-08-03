<?php


class Database {

    private static $INSTANCE = null;
    private $mysqli,
            $HOST = "localhost",
            $USER = "root",
            $PASS = "123",
            $DBNAME = "php_auth_oop_latihan";

    public function __construct()
    {
        $this->mysqli = new mysqli( $this->HOST, $this->USER, $this->PASS, $this->DBNAME );
        if( mysqli_connect_error() ) {
            die('gagal koneksi');
        }
    }

    public static function getInstance()
    {
        if( !isset( self::$INSTANCE ) ) {
            self::$INSTANCE = new Database();
        }

        return self::$INSTANCE;

    }

}

Database::getInstance();