<?php include('db/db_connect.php'); ?>

<!DOCTYPE html>
<html>

<head>
    <title>Scoreboard</title>
    <meta http-equiv="refresh" content="10"> <!-- Auto refresh every 10 seconds -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #e9f0f7;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #333;
        }

        table {
            margin: auto;
            border-collapse: collapse;
            width: 60%;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #004499;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:first-child {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <h1>📊 Public Scoreboard</h1>

    <table>
        <tr>
            <th>Participant</th>
            <th>Total Points</th>
        </tr>

        <?php
        $sql = "SELECT users.display_name, COALESCE(SUM(scores.points), 0) AS total_points 
                FROM users 
                LEFT JOIN scores ON users.id = scores.user_id 
                GROUP BY users.id 
                ORDER BY total_points DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['display_name']) ?></td>
                    <td><?= (int) $row['total_points'] ?></td>
                </tr>
                <?php
            endwhile;
        else:
            echo "<tr><td colspan='2'>No users or scores yet.</td></tr>";
        endif;
        ?>
    </table>
</body>

</html>