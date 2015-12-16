<?php

/** Credit to James - https://github.com/lyphiard for Database class */
class Database {
   private static $instance;
   public $pdo, $query, $error = false, $error_message, $results, $count = 0;
   public static function getInstance() {
      if (null == static::$instance) {
         static::$instance = new static();
      }
      return static::$instance;
   }
   protected function __construct() {
   }
   public function connect($host, $username, $password, $database) {
      try {
         $this->pdo = new PDO('mysql:host=' . $host . ';dbname=' . $database, $username, $password);
      }
      catch (PDOException $e) {
         die($e->getMessage());
      }
   }
   public function query($stmt, $params = array()) {
      $this->error = false;
      if ($this->query = $this->pdo->prepare($stmt)) {
         $x = 1;
         if (count($params)) {
            foreach ($params as $param) {
               $this->query->bindValue($x, $param);
               $x++;
            }
         }
         if ($this->query->execute()) {
            $this->results = $this->query->fetchAll(PDO::FETCH_OBJ);
            $this->count   = $this->query->rowCount();
         } else {
            $this->error         = true;
            $this->error_message = $this->query->errorInfo();
         }
      }
      return $this;
   }
}

$app->db = Database::getInstance();
if (filter_var(config('settings.use-database'), FILTER_VALIDATE_BOOLEAN)) {
   $app->db->connect(config('database.host'), config('database.username'), config('database.password'), config('database.database'));
}

?>
