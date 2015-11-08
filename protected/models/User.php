<?php

/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/7/15
 * Time: 8:50 PM
 */

//Example Model
class User
{

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function create($email, $password) {
        $db = $this->db;
        $db->query("INSERT INTO `accounts` (`email`, `password`) VALUES(?, ?)", array(
           'email' => $email,
           'password' => $password
        ));
    }

    public function getUsers() {
        $db = $this->db;
        $res = $db->query("SELECT `id`, `email` FROM `accounts`");
        return $res->results;
    }

}