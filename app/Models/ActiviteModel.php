<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class ActiviteModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function getAllActivities(): array
    {
        $sql = "SELECT * FROM activities";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActivityById(int $id): array
    {
        $sql = "SELECT * FROM activities WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: [];
    }

    public function getPlacesLeft(int $id): int
    {
        // places disponibles - reservations confirmées
        $sql = "
            SELECT a.places_disponibles - COUNT(r.id) AS places_restantes
            FROM activities a
            LEFT JOIN reservations r ON r.activite_id = a.id AND r.etat = 1
            WHERE a.id = ?
        ";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int) $res['places_restantes'];
    }

    public function createActivity(array $data): bool
    {
        $sql = "INSERT INTO activities (nom, type_id, places_disponibles, description, datetime_debut, duree)
                VALUES (:nom, :type_id, :places, :description, :debut, :duree)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':nom' => $data['nom'],
            ':type_id' => $data['type_id'],
            ':places' => $data['places_disponibles'],
            ':description' => $data['description'],
            ':debut' => $data['datetime_debut'],
            ':duree' => $data['duree']
        ]);
    }

    public function updateActivity(int $id, array $data): bool
    {
        $sql = "UPDATE activities 
                SET nom = :nom, type_id = :type_id, places_disponibles = :places, 
                    description = :description, datetime_debut = :debut, duree = :duree
                WHERE id = :id";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nom' => $data['nom'],
            ':type_id' => $data['type_id'],
            ':places' => $data['places_disponibles'],
            ':description' => $data['description'],
            ':debut' => $data['datetime_debut'],
            ':duree' => $data['duree']
        ]);
    }

    public function deleteActivity(int $id): bool
    {
        // supprimer les réservations liées
        $this->db->prepare("DELETE FROM reservations WHERE activite_id = ?")->execute([$id]);

        // supprimer l'activité
        return $this->db->prepare("DELETE FROM activities WHERE id = ?")->execute([$id]);
    }
}
