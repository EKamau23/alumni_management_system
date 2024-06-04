<?php

namespace App\Controllers;

include_once __DIR__ . '\config\database.php';
include_once __DIR__ . 'app\models\User.php';
include_once __DIR__ . 'app\models\Profile.php';
include_once __DIR__ . 'app\models\Job.php';

class AdminController {
    private $db;
    private $user;
    private $profile;
    private $job;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
        $this->profile = new Profile($this->db);
        $this->job = new Job($this->db);
    }

    public function profile() {
        session_start();
        if ($_SESSION['role'] != 'admin') {
            header('Location: ../public/index.php');
            exit();
        }

        $this->profile->user_id = $_SESSION['user_id'];
        $profile = $this->profile->read()->fetch(PDO::FETCH_ASSOC);

        include '../views/admin/edit_profile.php';
    }

    public function updateProfile($data) {
        session_start();
        if ($_SESSION['role'] != 'admin') {
            header('Location: ../public/index.php');
            exit();
        }

        $this->profile->user_id = $_SESSION['user_id'];
        $this->profile->name = $data['name'];
        $this->profile->email = $data['email'];
        $this->profile->phone = $data['phone'];
        $this->profile->address = $data['address'];

        if ($this->profile->update()) {
            header('Location: admin_dashboard.php');
        }
    }

    public function postJob($data) {
        session_start();
        if ($_SESSION['role'] != 'admin') {
            header('Location: ../public/index.php');
            exit();
        }

        $this->job->title = $data['title'];
        $this->job->description = $data['description'];
        $this->job->posted_by = $_SESSION['user_id'];

        if ($this->job->create()) {
            header('Location: admin_dashboard.php');
        }
    }

    public function manageUsers() {
        session_start();
        if ($_SESSION['role'] != 'admin') {
            header('Location: ../public/index.php');
            exit();
        }

        $users = $this->user->readAll()->fetchAll(PDO::FETCH_ASSOC);

        include '../views/admin/manage_users.php';
    }

    public function viewJobs() {
        session_start();
        if ($_SESSION['role'] != 'admin') {
            header('Location: ../public/index.php');
            exit();
        }

        $jobs = $this->job->readAll()->fetchAll(PDO::FETCH_ASSOC);

        include '../views/admin/view_jobs.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AdminController();

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'updateProfile':
                $controller->updateProfile($_POST);
                break;
            case 'postJob':
                $controller->postJob($_POST);
                break;
        }
    }
}
?>
