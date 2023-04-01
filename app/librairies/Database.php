<?php
define("APPROOT","Login");
define("URLROOT","http://Hospital.fr") ;
define("DB.NAME","Hospital");
define("HOST","localhost");
define("DB.USER","ygaudich");
define("DB.PASSWORD","erty");

class Database {
    private $host = "localhost";
    private $dbname = "Hospital";
    private $dbusername = "ygaudich";
    private $dbpassword = "erty";
    protected $_connexion;
    private $statement;

    public function __construct()
    {
        $this->_connexion = null;
        try {
            $this->_connexion = new PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->dbname,
                $this->dbusername,
                $this->dbpassword
            );
        } catch (PDOException $exception) {
            echo "Err :" . $exception->getMessage();
        }
    }

    public function prepare(string $sql) { 
        $this->statement = $this->_connexion->prepare($sql); }

    public function execute() { $this->statement->execute(); }

    public function single() {
        $this->execute();
        return $this->statement->fetch(); }

    public function resultSet() {
        $this->execute();
        return $this->statement->fetchAll();  }

    public function rowCount() {
        if ($this->statement) {
            $this->statement->execute();
            return $this->statement->rowCount();
        } else {
            return 0;
        }
    }
    

}