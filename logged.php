<!-- hacer aqui el cambio de contraseña una vez logeado y mostrar un boton logout-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged</title>
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
    echo "<ul>";
    echo "  <li><a href='changePass.php'>Change password</a></li>";
    echo "  <li>Create users</li>";
    echo "  <li><a href='index.php'>Log out</a></li>";
    echo "</ul>";
    ?>
</body>
</html>