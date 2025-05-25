<?php
$host = 'localhost';
$user = 'root';
$pass = ''; // Or 'your_password'
$dbname = 'judge_scoring';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>