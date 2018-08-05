<?php

class Users {

    private $_db;

    public function __construct()
    {
        $this->_db = Database::getInstance(); // untuk melakukan koneksi ke database kita
    }

    public function register_user($fields = array())
    {
        if( $this->_db->insert('users', $fields) ) return true;
        else return false;
    }


}


?>