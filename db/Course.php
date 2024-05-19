<?php
require_once('Database.php');

class Course
{
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->db();
    }

    public function create($params)
    {
        $query = "INSERT INTO courses (point_depart, point_arrivee, date_heure, chauffeur_id, statut) VALUES (:point_depart, :point_arrivee, :date_heure, :chauffeur_id, :statut)";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function read()
    {
        $query = "SELECT * FROM courses";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readWithChauffeurs()
    {
        $query = "SELECT c.*, ch.nom AS chauffeur_nom, ch.prenoms AS chauffeur_prenoms FROM courses c JOIN chauffeurs ch ON c.chauffeur_id = ch.chauffeur_id ORDER BY c.course_id DESC";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function readById($course_id)
    {
        $query = "SELECT c.course_id, c.point_depart, c.point_arrivee, c.date_heure, c.chauffeur_id, c.statut, ch.nom AS chauffeur_nom, ch.prenoms AS chauffeur_prenoms 
                  FROM courses c
                  INNER JOIN chauffeurs ch ON c.chauffeur_id = ch.chauffeur_id
                  WHERE c.course_id = :course_id";

        $stmt = $this->db->prepare($query);

        $stmt->bindParam(':course_id', $course_id);

        $stmt->execute();

        $course = $stmt->fetch(PDO::FETCH_ASSOC);

        return $course;
    }


    public function update($params)
    {
        $query = "UPDATE courses SET point_depart = :point_depart, point_arrivee = :point_arrivee, date_heure = :date_heure, chauffeur_id = :chauffeur_id, statut = :statut WHERE course_id = :course_id";
        $stmt = $this->db->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($course_id)
    {
        $query = "DELETE FROM courses WHERE course_id = :course_id";
        $stmt = $this->db->prepare($query);
        $params = array(':course_id' => $course_id);
        return $stmt->execute($params);
    }
}