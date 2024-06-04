<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Jobs</title>
    <link rel="stylesheet" href="../../public/css/style.css">
</head>
<body>
    <h1>View Jobs</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Posted By</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($jobs as $job) {
                echo "<tr>";
                echo "<td>" . $job['id'] . "</td>";
                echo "<td>" . $job['title'] . "</td>";
                echo "<td>" . $job['description'] . "</td>";
                echo "<td>" . $job['posted_by'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>
