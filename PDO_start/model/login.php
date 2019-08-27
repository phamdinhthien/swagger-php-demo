<?php
    class Login{
        private $table = 'students';
        public $id;
        public $name;
        private $conn;

        public function __construct($db){
            $this->conn = $db;
        }

        public function checkLogin(){
            $query = 'select * from students where name= ? ';
            $stm = $this->conn->prepare($query);
            $stm->bindParam(1, $this->name);
            $stm->execute();
            $num = $stm->rowCount();
            if($num > 0){
                $row = $stm->fetch(PDO::FETCH_ASSOC);
                $this->name = $row['name'];
                $this->id = $row['id'];
                return true;
            }
            return false;
        }
    }
?>