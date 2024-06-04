<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: ../alumni/dashboard.php');
    exit();
}

include_once '../../config/database.php';
include_once '../../models/User.php';

$user = new User($database->getConnection());

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($user->register($username, $email, $password)) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['role'] = $user->role;
        header('Location: ../alumni/dashboard.php');
        exit();
    } else {
        $error = "Registration failed. Please try again.";
    }
}
?>
<html>
<head>
    <title>IST Alumni System - Register</title>
</head>
<body>
    <h2>Register</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Register">
    </form>
</body>
</html>
