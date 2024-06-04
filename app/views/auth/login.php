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
    $password = $_POST['password'];

    if ($user->login($username, $password)) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['role'] = $user->role;
        header('Location: ../alumni/dashboard.php');
        exit();
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<html>
<head>
    <title>IST Alumni System - Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
