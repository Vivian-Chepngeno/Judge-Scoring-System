<?php
include('../db/db_connect.php');

$result = $conn->query("
    SELECT users.name, SUM(scores.points) AS total_points
    FROM users
    LEFT JOIN scores ON users.id = scores.user_id
    GROUP BY users.id
    ORDER BY total_points DESC
");
?>

<html>

<head>
    <meta http-equiv="refresh" content="10"> <!-- Refresh every 10 seconds -->
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body>
    <h2>Public Scoreboard</h2>
    <table border="1">
        <tr>
            <th>User</th>
            <th>Total Points</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['name'] ?></td>
                <td><?= $row['total_points'] ?? 0 ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>