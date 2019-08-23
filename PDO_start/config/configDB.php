<?php 
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = 'Thien99.vn';
    private $dbname = 'testUTF8';
    public $conn;
    public function getConnection(){
        $this->conn = null;
        try{
        $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
        $pdo = new PDO($dsn, $this->username, $this->password);
        $this->conn = $pdo;
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>