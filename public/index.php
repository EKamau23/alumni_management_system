<?php

include_once 'config/database.php'; // Include the database configuration file

// Instantiate the AdminController directly
$controller = new App\Controllers\AdminController();

// Route the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

// Assuming you have the 'controller' and 'action' parameters in the URL
$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'admin';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

$controller->route($controllerName, $action);

?>
