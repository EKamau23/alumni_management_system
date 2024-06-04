<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Job</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1>Post Job</h1>
    <form action="../../app/controllers/AdminController.php" method="post">
        <input type="hidden" name="action" value="postJob">
        <label for="title">Job Title:</label>
        <input type="text" name="title" required>
        <label for="description">Job Description:</label>
        <textarea name="description" required></textarea>
        <input type="submit" value="Post Job">
    </form>
</body>
</html>
