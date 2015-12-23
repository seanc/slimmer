<?php  

class User {

    private $db;

    public function __construct() {
        $this->db = Database::getInstance();
    } 

    public function get($uuid) {
        $db = $db->query('SELECT * FROM `users` WHERE `uuid`=?', array(
            'uuid' => $uuid
            // instead of defining a key, you can just put the value as well
        ));
    }

}

?>