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

    public function insert($table, $fields = array())
    {
        // mengambil kolumn
        $column = implode(", ", array_keys($fields) );

        // menganti nilai;
        $valueArrays = array();
        $i = 0;
        foreach( $fields as $key=>$values ) {
            if( is_int($values) ) {
                $valueArrays[$i] = $this->escape($values);
            } else {
                $valueArrays[$i] = "'" . $this->escape($values) . "'";
            }
            
            $i++;
        }
        $values = implode(", ", $valueArrays ); // implode menggabungkan array

        // INSERT INTO $table ($kolom) VALUES ($nilai)

        $query = "INSERT INTO $table ($column) VALUES ($values)";

        // die($query);
        return $this->run_query($query, 'masalah saat memasukan data');

    }


    public function get_info($table, $column, $value) 
    {
        if( !is_int($value) )
            $value = "'" . $value . "'";

        $query = "SELECT * FROM $table WHERE $column = $value";
        $result = $this->mysqli->query($query);

        while ($row = $result->fetch_assoc()) {
            return $row;
        }
    }


    public function run_query($query, $msg)
    {
        if( $this->mysqli->query($query) or die($msg) ) return true;
        else return false;
    }

    public function escape($name)
    {
        return $this->mysqli->real_escape_string($name);
    }

}

Database::getInstance();