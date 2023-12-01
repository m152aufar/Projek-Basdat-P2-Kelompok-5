<?php
session_start();
include("inc_koneksi.php");

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "easytaskeasylife1";

$conn = mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_SESSION['session_username'])) {
    header("location:login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login and Registration</title>
    <link rel="icon" type="image/png" href="image/logo1.png" sizes="32x32" />
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>

<div class="message-container">
    <?php
    if (isset($_POST["register"]) || isset($_POST["login"])) {
        $showMessageContainer = !empty($errors);
    
        if ($showMessageContainer) {
            echo '<div class="message-container ' . ($errors ? 'danger' : 'success') . ' show">';
            foreach ($errors as $error) {
                echo "<div class='alert alert-" . ($errors ? 'danger' : 'success') . "'>$error</div>";
            }
            echo '</div>';
        }
    }

    if (isset($_POST["register"])) {
        $nama = $_POST["nama"];
        $username = $_POST["username"];
        $password = $_POST["password"];

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $errors = array();

        if (empty($nama) OR empty($username) OR empty($password)) {
            array_push($errors, "All fields are required");
        }

        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }

        $sql = "SELECT * FROM register WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);

        if ($rowCount > 0) {
            array_push($errors, "Username already exists!");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            $sql = "INSERT INTO register (nama, username, password) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);

            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt, "sss", $nama, $username, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            } else {
                die("Something went wrong");
            }
        }
    }

    if (isset($_POST["login"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM register WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if ($user) {
            if (password_verify($password, $user["password"])) {
                $_SESSION["session_username"] = $username;
                $_SESSION["session_password"] = $password;
                header("Location: fungsi.php");
                exit();
            } else {
                echo "<div class='alert alert-danger'>Password is incorrect</div>";
            }
        } else {
            echo "<div class='alert alert-danger'>Username does not exist</div>";
        }
    }
    ?>
</div>

<div class="container" id="container">

    <!-- Regis -->
    <div class="form-container register-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1>Register</h1>
            <input type="text" name="nama" placeholder="nama" value="<?php echo isset($nama) ? $nama : ''; ?>">
            <input type="text" name="username" placeholder="username" value="<?php echo isset($username) ? $username : ''; ?>">
            <input type="password" name="password" placeholder="password">
            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <!-- Login -->
    <div class="form-container login-container">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <div class="content">

            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>

    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1 class="title">Hello <br> friends</h1>
                <p>If you have an account, log in here and have fun</p>
                <button class="ghost" id="login">Login
                    <i class="lni lni-arrow-left login"></i>
                </button>
            </div>
            <div class="overlay-panel overlay-right">
                <h1 class="title">Start your <br> journey now</h1>
                <p>If you don't have an account yet, join us and start your journey.</p>
                <button class="ghost" id="register">Register
                    <i class="lni lni-arrow-right register"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<script src="script.js"></script>

</body>
