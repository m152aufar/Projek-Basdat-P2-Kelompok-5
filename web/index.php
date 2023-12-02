<?php
session_start();
include_once("inc/inc_fungsi.php");

$isUserLoggedIn = isset($_SESSION['session_username']);
$loggedInUsername = $isUserLoggedIn ? $_SESSION['session_username'] : null;

if (isset($_POST['logout'])) {

    session_destroy();

    header('Location: Login Page/index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Easy Task Easy Life</title>
    <link rel="icon" type="image/png" href="image/logo12.png" sizes="32x32" />
    <link rel="stylesheet" href="css/udinn.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script src="tombol.js" defer></script>

</head>

<body>
<nav>
    <div class="wrapper">
        <div class="logo">
            <span class="easy">Easy</span><span class="task">Task</span><span class="easy">Easy</span><span
                class="life">Life</span>
        </div>
        <a href="#" class="tombol-menu">
            <span class="garis"></span>
            <span class="garis"></span>
            <span class="garis"></span>
        </a>
        <div class="menu">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="#start">Start</a></li>
                <li><a href="#founders">Founders</a></li>
                <?php if ($isUserLoggedIn) : ?>
                    <!-- Tampilan klo dah login -->
                <li class="user-profile">
                        <p1>Welcome, <?php echo $loggedInUsername; ?>!</p1>

                    </li>
                    <!-- Logout klo pgn keluar -->
                    <li>
                        <form method="post" action="logout.php">
                            <button type="submit" name="logout" class="tbl-biru">Logout</button>
                        </form>
                    </li>
                <?php else : ?>
                    <!-- Sign In klo gk login -->
                <li><a href="login.php" class="tbl-biru">Sign In</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

    <div class="wrapper">
        <section id="home">
            <h1>
                <img src="gambar_2/a_teenage_boy.png" />
            </h1>

            <div class="kolom">
                <p class="deskripsi">Easy Task Easy Life</p>
                <h2>Where Productivity Meets Simplicity.</h2>
                <?php
                $kalimatSelamatDatang =
                    "Selamat datang di Easy Task Easy Life – tempat di mana produktivitas bertemu dengan kesederhanaan. Kami memahami betapa berharganya waktumu, dan itulah mengapa Easy Task Easy Life hadir sebagai teman setiamu dalam mengorganisir tugas dan kegiatan sehari-hari.";
                ?>
                <p id="kalimatAwal"><?php echo substr($kalimatSelamatDatang, 0); ?></p>
                <p><a class="tbl-pink" href="#" onclick="tampilkanKalimat()">Baca Lebih Lanjut</a></p>
            </div>
        </section>

        <!-- untuk mulai -->
        <section id="start">
            <h1>
                <img src="gambar_2/wellcome.png" />
            </h1>
            <div class="kolom">
                <p class="deskripsi">👋 Welcome to Easy Task Easy Life!</p>
                <h2>Getting Started</h2>
                <p>Mulailah perjalanan produktif dan sederhana bersama Easy Task Easy Life. Temukan kemudahan mengelola tugas dan buka potensi penuh setiap harimu. Bersama Easy Task Easy Life, setiap tugas menjadi langkah menuju efisiensi dan kebahagiaan.</p>
                <?php if ($isUserLoggedIn) : ?>
                    <!-- User udah login?? -->
                    <p><a href="http://localhost/web/fitur/task_list/halaman.php" class="tbl-pink">Start</a></p>
                <?php else : ?>
                    <p>Please <a href="index.php" >sign in</a> to start.</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- untuk founders -->
        <section id="founders">
            <div class="tengah">
                <div class="kolom">
                    <p class="deskripsi">Our Founder</p>
                    <h2>Founder</h2>
                    <p></p>
                </div>

                <div class="founder-list">
                    <div class="kartu-founder">
                        <img src="image/nis.jpeg" />
                        <p>Nisrina</p>
                    </div>
                    <div class="kartu-founder">
                        <img src="image/men.jpeg" />
                        <p>Meena</p>
                    </div>
                    <div class="kartu-founder">
                        <img src="image/ul.jpeg" />
                        <p>Maul</p>
                    </div>
                    <div class="kartu-founder">
                        <img src="image/far.jpeg" />
                        <p>Aufar</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>
