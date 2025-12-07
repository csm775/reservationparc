<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class UserModel
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::getConnection();
    }

    public function logUser(string $email, string $motdepasse): array
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($motdepasse, $user['motdepasse'])) {
            return $user;
        }

        return [];
    }

    public function createUser(array $data): bool
    {
        $sql = "INSERT INTO users (prenom, nom, email, motdepasse, role)
                VALUES (:prenom, :nom, :email, :motdepasse, 'user')";

        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':prenom' => $data['prenom'],
            ':nom' => $data['nom'],
            ':email' => $data['email'],
            ':motdepasse' => password_hash($data['motdepasse'], PASSWORD_DEFAULT)
        ]);
    }

    public function getAllUsers(): array
    {
        $sql = "SELECT * FROM users ORDER BY nom";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }
}
