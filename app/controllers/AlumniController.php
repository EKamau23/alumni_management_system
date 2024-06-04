<?php

namespace App\Controllers;

include_once '../config/database.php';
include_once '../models/User.php';
include_once '../models/Profile.php';
include_once '../models/Job.php';

class AlumniController {
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
        if ($_SESSION['role'] != 'alumni') {
            header('Location: ../public/index.php');
            exit();
        }

        $this->profile->user_id = $_SESSION['user_id'];
        $profile = $this->profile->read()->fetch(PDO::FETCH_ASSOC);

        include '../views/alumni/edit_profile.php';
    }

    public function updateProfile($data) {
        session_start();
        if ($_SESSION['role'] != 'alumni') {
            header('Location: ../public/index.php');
            exit();
        }

        $this->profile->user_id = $_SESSION['user_id'];
        $this->profile->name = $data['name'];
        $this->profile->email = $data['email'];
        $this->profile->phone = $data['phone'];
        $this->profile->address = $data['address'];

        if ($this->profile->update()) {
            header('Location: alumni_dashboard.php');
        }
    }

    public function viewJobs() {
        session_start();
        if ($_SESSION['role'] != 'alumni') {
            header('Location: ../public/index.php');
            exit();
        }

        $jobs = $this->job->readAll()->fetchAll(PDO::FETCH_ASSOC);

        include '../views/alumni/view_jobs.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new AlumniController();

    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'updateProfile':
                $controller->updateProfile($_POST);
                break;
        }
    }
}
?>
