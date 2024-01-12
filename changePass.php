<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <?php
    session_start();
    if (!isset($_SESSION["login"])) {
        http_response_code(403);
        echo "<h1>403 Forbidden</h1>
        <a href='index.php'>Please LOG IN.</a>";
        exit;
    }
    echo "<h1>Welcome ".$_SESSION['login']."</h1>";
    echo "<h1>Change Password</h1>";
    if (isset($_POST["password"]) && isset($_POST["newpassword"]) && isset($_POST["newpassword2"])) {
        if ($_POST["newpassword"] != $_POST["newpassword2"]) {
            echo "<p>The new passwords does not match.</p>";
        }
    }
    ?>
    <form method="post">
        <input type="password" name="password" placeholder="Old password" required><br>
        <input type="password" name="newpassword" placeholder="New password" required><br>
        <input type="password" name="newpassword2" placeholder="Repeat new password" required><br>
        <input type="submit"><br>
    </form>
</body>
</html>