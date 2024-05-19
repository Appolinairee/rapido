<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "rapido";
    private $db;

    public function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname";
            $this->db = new PDO($dsn, $this->username, $this->password);
        } catch (PDOException $e) {
            die("Erreur : " . $e->getMessage());
        }
    }

    public function db()
    {
        return $this->db;
    }


}