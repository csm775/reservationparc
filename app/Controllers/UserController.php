<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Auth;
use App\Models\UserModel;

class UserController extends Controller
{
    private UserModel $userModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        if (!Auth::checkAdmin()) {
            echo "Accès interdit";
            return;
        }
        $users = $this->userModel->getAllUsers();
        $this->view('user/index', ['users' => $users]);
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'prenom' => $_POST['prenom'],
                'nom' => $_POST['nom'],
                'email' => $_POST['email'],
                'motdepasse' => $_POST['motdepasse']
            ];

            if ($this->userModel->createUser($data)) {
                header('Location: /user/login');
                exit;
            } else {
                echo "Erreur inscription";
            }
        }

        $this->view('user/register');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['motdepasse'];

            $user = $this->userModel->logUser($email, $password);

            if (!empty($user)) {
                $_SESSION['user'] = $user;
                header('Location: /');
                exit;
            } else {
                echo "Email ou mot de passe incorrect";
            }
        }

        $this->view('user/login');
    }

    public function logout()
    {
        Auth::logout();
        header('Location: /');
        exit;
    }
}
