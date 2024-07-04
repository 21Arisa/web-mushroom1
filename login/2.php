<?php
session_start(); // Start the session

// Assuming you have a database connection already established as $conn
require("../help/connect.php"); // Adjust according to your setup

// Retrieve the form data
$username = $_POST['username'];
$password = $_POST['password'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$type = $_POST['type_id'];

// Check if the username already exists in the database
$query = "SELECT * FROM users WHERE user_username = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Username already exists
    $_SESSION["Error"] = "Username นี้ถูกใช้ไปแล้ว";
    header("Location: 1.php");
    exit();
} else {
    // Insert the new user into the database (this part may vary depending on your registration process)
    $insertQuery = "INSERT INTO users (user_username, user_userpassword, user_firstname, user_lastname, type_id) VALUES (?, ?, ?, ?, ?)";
    $insertStmt = $conn->prepare($insertQuery);
    $insertStmt->bind_param("sssss", $username, $password, $firstname, $lastname, $type);
    $insertStmt->execute();

    // Set session variables
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;

    // Redirection based on user type
    if ($type == "ex_02") {
        header("Location: ../explorer/1.php");
        exit();
    } elseif ($type == "ad_01") {
        header("Location: ../1.php");
        exit();
    }
}
?>
