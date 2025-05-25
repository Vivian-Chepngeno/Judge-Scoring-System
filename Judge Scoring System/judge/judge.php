<?php include('../db/db_connect.php'); ?>


<!DOCTYPE html>
<html>

<head>
    <title>Judge Portal</title>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        select,
        input[type="number"],
        button {
            width: 100%;
            padding: 10px;
            margin: 15px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>🧑‍⚖️ Judge Portal - Score Users</h2>

        <form method="post">
            <label>Select User:</label>
            <select name="user_id" required>
                <option value="">-- Choose a User --</option>
                <?php
                $result = $conn->query("SELECT id, display_name FROM users");
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['display_name']}</option>";
                }
                ?>
            </select>

            <label>Enter Score (1-100):</label>
            <input type="number" name="points" min="1" max="100" required>

            <!-- In real app, judge_id would come from login -->
            <input type="hidden" name="judge_id" value="1">

            <button type="submit">Submit Score</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $judge_id = $_POST['judge_id'];
            $user_id = $_POST['user_id'];
            $points = $_POST['points'];

            $stmt = $conn->prepare("INSERT INTO scores (judge_id, user_id, points) VALUES (?, ?, ?)");
            $stmt->bind_param("iii", $judge_id, $user_id, $points);

            if ($stmt->execute()) {
                echo "<p class='message success'>Score submitted successfully! 🎯</p>";
            } else {
                echo "<p class='message error'>Error: " . htmlspecialchars($stmt->error) . "</p>";
            }
        }
        ?>
    </div>
</body>

</html>