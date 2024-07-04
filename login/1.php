<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <?php
    if (isset($_SESSION["Error"])) {
        echo "<p style='color:red'>" . $_SESSION["Error"] . "</p>";
        unset($_SESSION["Error"]); // Clear the error after displaying it
    }
    ?>

    <form action="2.php" method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required>
        <br>
        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required>
        <br>
        <label for="type_id">Type ID:</label>
        <input type="text" id="type_id" name="type_id" required>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
