<?php

namespace App\Controllers;

include_once '../config/database.php';
include_once '../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login($username, $password) {
        if ($this->user->login($username, $password)) {
            session_start();
            $_SESSION['user_id'] = $this->user->id;
            $_SESSION['role'] = $this->user->role;
            header('Location: ../alumni/dashboard.php');
            exit();
        } else {
            $error = "Invalid username or password.";
            include '../views/auth/login.php';
        }
    }

    public function register($username, $email, $password) {
        if ($this->user->register($username, $email, $password)) {
            session_start();
            $_SESSION['user_id'] = $this->user->id;
            $_SESSION['role'] = $this->user->role;
            header('Location: ../alumni/dashboard.php');
            exit();
        } else {
            $error = "Registration failed. Please try again.";
            include '../views/auth/register.php';
        }
    }
}

$authController = new AuthController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'login':
                $authController->login($_POST['username'], $_POST['password']);
                break;
            case 'register':
                $authController->register($_POST['username'], $_POST['email'], $_POST['password']);
                break;
        }
    }
}
?>
