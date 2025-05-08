<?php
require_once __DIR__ . '/../models/UserModel.php';
require_once __DIR__ . '/../includes/config.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new UserModel($pdo);
    }

    public function login($email, $password) {
        $user = $this->userModel->getByEmail($email);

        if (!$user) {
            echo "<div class='alert alert-danger text-center'>Email incorrect.</div>";
            return false;
        }

        if (password_verify($password, $user['mot_de_passe'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];

            switch ($user['role']) {
                case 'admin':
                    header("Location: ../views/admin/dashboard.php");
                    break;
                case 'manager':
                    header("Location: ../views/manager/dashboard.php");
                    break;
                case 'employe':
                    header("Location: ../views/employe/dashboard.php");
                    break;
                default:
                    echo "<div class='alert alert-warning text-center'>Rôle inconnu.</div>";
                    return false;
            }
            exit();
        } else {
            echo "<div class='alert alert-danger text-center'>Mot de passe incorrect.</div>";
            return false;
        }
    }
}
