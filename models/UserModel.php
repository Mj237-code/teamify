<?php
class UserModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Récupère un utilisateur par son e-mail
    public function getByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Récupère un utilisateur par son ID
    public function getById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crée un nouvel utilisateur avec mot de passe haché
    public function create($nom, $email, $mot_de_passe, $role) {
        $hashedPassword = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (nom, email, mot_de_passe, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $email, $hashedPassword, $role]);
    }

    // Vérifie les identifiants de connexion
    public function verifyCredentials($email, $mot_de_passe) {
        $user = $this->getByEmail($email);
        if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
            return $user;
        }
        return false;
    }

    // Met à jour les infos d'un utilisateur
    public function update($id, $nom, $email) {
        $stmt = $this->pdo->prepare("UPDATE utilisateur SET nom = ?, email = ? WHERE id = ?");
        return $stmt->execute([$nom, $email, $id]);
    }
}
