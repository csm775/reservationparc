<?php
namespace App\Models;

use App\Core\Database;

class ReservationModel
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function createReservation(int $userId, int $activityId): bool
    {
        $stmt = $this->db->prepare("INSERT INTO reservations (user_id, activite_id) VALUES (?, ?)");
        return $stmt->execute([$userId, $activityId]);
    }

    public function getReservationsByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT r.*, a.nom AS activite 
                                    FROM reservations r 
                                    JOIN activities a ON r.activite_id = a.id 
                                    WHERE r.user_id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function cancelReservation(int $reservationId): bool
    {
        $stmt = $this->db->prepare("UPDATE reservations SET etat = 0 WHERE id = ?");
        return $stmt->execute([$reservationId]);
    }
}
