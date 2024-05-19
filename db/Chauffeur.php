<?php
require_once('Database.php');

class Chauffeur
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->db();
    }

    public function create($params)
    {
        $query = "INSERT INTO chauffeurs (nom, prenoms, telephone, sexe, disponible) VALUES (:nom, :prenoms, :telephone, :sexe, :disponible)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function read()
    {
        $query = "SELECT * FROM chauffeurs";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($chauffeur_id)
    {
        $query = "SELECT * FROM chauffeurs WHERE chauffeur_id = :chauffeur_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':chauffeur_id', $chauffeur_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($params)
    {
        $query = "UPDATE chauffeurs SET nom = :nom, prenoms = :prenoms, telephone = :telephone, sexe = :sexe, disponible = :disponible WHERE chauffeur_id = :chauffeur_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($chauffeur_id)
    {
        $query = "DELETE FROM chauffeurs WHERE chauffeur_id = :chauffeur_id";
        $stmt = $this->db->prepare($query);
        $params = array(':chauffeur_id' => $chauffeur_id);
        return $stmt->execute($params);
    }
}
