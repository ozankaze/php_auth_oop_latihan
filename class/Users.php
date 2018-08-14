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

    public function login_user($username, $password)
    {
        // "SELECT * FROM users WHERE username = username";
        $data = $this->_db->get_info('users', 'username', $username);
        // print_r($data);die();


        if( password_verify($password, $data['password']) ) {
            // $data->daridatabase
            return true;
        } else {
            return false
        };
    }

}


?>