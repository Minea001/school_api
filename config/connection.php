<?php

class connection {
   private $user_name = "root";
   private $password = "";
   private $database = "school_ms";
   private $host_name = "localhost";
   public $conn;

   /**
    * Class constructor.
   */
   function __construct()
   {
      $this->get_connection();
   }
   public function get_connection()
   {
      
      $this->conn = mysqli_connect($this->host_name, $this->user_name, $this->password, $this->database);
      // $this->conn->set_charset("utf8mb4"); // support khmer unicode

      if ($this->conn->connect_error) {
         print("Connect error !..". $this->conn->connect_error);
      } else {
         // echo "connection success!";
      }
      return $this->conn;
   }

   public function fun_closecon()
   {
      mysqli_close($this->conn);
   }

   public function success($data) {
      return print json_encode($data);
   }
}
?>