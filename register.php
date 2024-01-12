<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php
    if (isset($_POST["name"]) && isset($_POST["password"]) && isset($_POST['password2'])) {
        if ($_POST["password"] != $_POST["password2"]) {
            echo "<p>The passwords are not the same.</p>";
        } else {
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
            $userName = $_POST['name'];
            $userpass = $_POST['password'];
            $userpass2 = $_POST['password2'];
    
            $query = $pdo -> prepare("SELECT nom FROM users WHERE nom = ?");
            $query->bindParam(1, $userName, PDO::PARAM_STR);
            $query->execute();
    
            //comprovo errors:
            $e = $query -> errorInfo();
            if ($e[0]!='00000') {
                echo "\nPDO::errorInfo():\n";
                die("Error accedint a dades: " . $e[2]);
            }
    
            $row = $query -> fetch();
            if (!$row) { // no existe el usuario asi que lo creas'
                $string = "INSERT INTO users (nom, contrasenya) VALUES (?, SHA2(?, 512))";
                $query = $pdo -> prepare($string);
                $query->bindParam(1, $userName, PDO::PARAM_STR);
                $query->bindParam(2, $userpass, PDO::PARAM_STR);
                $query->execute();
                
                echo "<p>Your account is waiting for you!</p>";
                echo "<a href='index.php'>Log In.</a>";
            } else { // existe el usuario asi que vuelves a intentarlo
                echo "<p>The username ".$row["nom"]." already exist. Choose another one.</p>";
            }
        }
    }
    ?>
    <h1>Register</h1>
    <form method="POST">
        <input type="text" name="name" placeholder="user" required><br>
        <input type="password" name="password" placeholder="password" required><br>
        <input type="password" name="password2" placeholder="Repeat password" required><br>
        <input type="submit"><br>
        <a href="index.php">Already have an account? Sign In.</a>
    </form>
</body>
</html>