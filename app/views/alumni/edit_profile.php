<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1>Edit Profile</h1>
    <form action="../../app/controllers/AlumniController.php" method="post">
        <input type="hidden" name="action" value="updateProfile">
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $profile['name']; ?>" required>
        <label for="email">Email:</label>
        <input type="email" name="email" value="<?php echo $profile['email']; ?>" required>
        <label for="phone">Phone:</label>
        <input type="text" name="phone" value="<?php echo $profile['phone']; ?>" required>
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo $profile['address']; ?>" required>
        <input type="submit" value="Update Profile">
    </form>
</body>
</html>
