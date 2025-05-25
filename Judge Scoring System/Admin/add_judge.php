<?php include('../db/db_connect.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Add Judge - Admin Panel</title>
    <style>
        body {
            background-color: #f9fafb;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            margin-bottom: 25px;
            color: #222;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px 0;
            border: 1.8px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #4a90e2;
            outline: none;
        }

        button {
            width: 100%;
            padding: 12px 0;
            background-color: #4a90e2;
            border: none;
            border-radius: 8px;
            color: white;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357abd;
        }

        .message {
            margin-top: 20px;
            font-size: 16px;
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

    <div class="form-container">
        <h2>➕ Add New Judge</h2>

        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required autocomplete="off" />
            <input type="text" name="display_name" placeholder="Display Name" required autocomplete="off" />
            <button type="submit">Add Judge</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $display_name = trim($_POST['display_name']);

            // Basic sanitization to avoid SQL injection is already handled by prepared statements
        
            $stmt = $conn->prepare("INSERT INTO judges (username, display_name) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $display_name);

            if ($stmt->execute()) {
                echo '<p class="message success">Judge added successfully.</p>';
            } else {
                echo '<p class="message error">Error: ' . htmlspecialchars($stmt->error) . '</p>';
            }
        }
        ?>
    </div>

</body>

</html>