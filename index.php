<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login bdd</title>
</head>
<body>
    <!-- La fita 6 trata de hacer un registro y la fita 7 trata de hacer un update de cambio de password -->
    <h1>Login</h1>
    <?php
        session_start();
        if (isset($_SESSION['login'])) {
            unset($_SESSION['login']);
        }
        if (isset($_POST['nom']) && isset($_POST['contrasenya'])) {  
            try {
                $hostname = "localhost";
                $dbname = "mylogin";
                $username = "usuariProba";
                $pw = "Chakala1_";
                $pdo = new PDO ("mysql:host=$hostname;dbname=$dbname","$username","$pw");
              } catch (PDOException $e) {
                echo "Failed to get DB handle: " . $e->getMessage() . "\n";
                exit;
            }
            $userName = $_POST['nom'];
            $userpass = $_POST['contrasenya'];

            $query = $pdo -> prepare("SELECT nom FROM users WHERE nom = ? AND contrasenya=SHA2(?, 512)");
            $query->bindParam(1, $userName, PDO::PARAM_STR);
            $query->bindParam(2, $userpass, PDO::PARAM_STR);
            $query->execute();

            //comprovo errors:
            $e = $query -> errorInfo();
            if ($e[0]!='00000') {
                echo "\nPDO::errorInfo():\n";
                die("Error accedint a dades: " . $e[2]);
            }

            $row = $query -> fetch();
            if (!$row) {
                echo "<p>Credencials invalides</p>";
            } else {
                $_SESSION["login"] = $userName;
                $newURL = "logged.php";
                header('Location: ' . $newURL);
                exit();
            }

        }
    ?>
    <form method="POST">
        <input type="text" name="nom" placeholder="usuari" required><br>
        <input type="password" name="contrasenya" placeholder="contrasenya" required><br>
        <input type="submit"><br>
        <a href="register.php">You don't have an account? Sign up</a>
    </form>
</body>
</html>