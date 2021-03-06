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


        if( password_verify($password, $data['password']) )
            // $data->daridatabase
            return true;
        else return false;
    }

    public function cek_nama($username)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        // print_r($data);
        if( empty($data) ) return false; 
        else return true;
    }

    public function is_admin($username)
    {
        $data = $this->_db->get_info('users', 'username', $username);
        // print_r($data);
        if( $data['role'] == 1 ) return true; 
        else return false;   
    }

    public function is_logIn()
    {
        if( Session::exists('username') ) {
            return true;
        } else {
            return false;
        }
    }

    public function get_data($username)
    {
        if( $this->cek_nama($username) ) {
            return $this->_db->get_info('users', 'username', $username);
        } else {
            return die('gagal');
        }
    }   

    public function update_user($fields = array(), $id)
    {
        if( $this->_db->update('users', $fields, $id) ) return true;
        else return false;
    }
}


?>