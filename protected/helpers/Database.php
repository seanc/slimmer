<?php

/**
 * Created by PhpStorm.
 * User: sean
 * Date: 11/7/15
 * Time: 8:54 PM
 */
class Database
{

    private static $instance;

    public $pdo, $query, $error = false, $error_message, $results, $count = 0;

    public static function getInstance() {
        if(null == static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function __construct() {}

    public function connect($details = array(), $username, $password) {
        try {
            $this->pdo = new PDO('mysql:host='. $details['host'] . ';dbname=' . $details['name'], $username, $password);

        } catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($stmt, $params = array()) {
        $this->error = false;
        if($this->query = $this->pdo->prepare($stmt)) {
            $x = 1;
            if(count($params)) {
                foreach($params as $param) {
                    $this->query->bindValue($x, $param);
                    $x++;
                }
            }
            if($this->query->execute()) {
                $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
                $this->count = $this->query->rowCount();
            } else {
                $this->error = true;
                $this->error_message = $this->query->errorInfo();
            }
        }

        return $this;
    }

}