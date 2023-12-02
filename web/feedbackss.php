<?php
session_start();
include_once("inc/inc_fungsi.php");
include_once("inc/inc_koneksi.php");
$isUserLoggedIn = isset($_SESSION['session_username']);
$loggedInUsername = $isUserLoggedIn ? $_SESSION['session_username'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <nav>
        <div class="wrapper">
            <div class="logo">
                <span class="easy">Easy</span><span class="task">Task</span><span class="easy">Easy</span><span class="life">Life</span>
            </div>
            <a href="#" class="tombol-menu">
                <span class="garis"></span>
                <span class="garis"></span>
                <span class="garis"></span>
            </a>
            <div class="menu">
                <ul>
                <li><a href="http://localhost/web/index.php">Home</a></li>
                    <li><a href="http://localhost/web/fitur/task_list/halaman.php">Task List</a></li>
                    <li><a href="http://localhost/web/fitur/calendar/dynamic-full-calendar.php">Calendar</a></li>
                    <li><a href="http://localhost/web/fitur/timer/timer.php">Timer</a></li>
                    <li><a href="http://localhost/web/fitur/review/feedbacks.php">Feedback</a></li>
                    <li class="user-profile">
                        <p1> <?php echo $loggedInUsername; ?></p1>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <title>Feedback Page</title>
    <link rel="icon" type="image/png" href="image/logo12.png" sizes="32x32" />
    <link rel="stylesheet" href="http://localhost/web/fitur/timer/css/head_timer.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Itim&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');
    body {

        font-family: "Poppins", sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }


    .feedback-form input,
    .feedback-form textarea {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
    box-sizing: border-box;
}

    .feedback-container {
        padding-top: 20px;
    }

    .feedback-item {
        margin-bottom: 20px;
        border: 1px solid #ddd;
        padding: 10px;
        border-radius: 5px;
    }

    .feedback-item p {
        margin-top: 10px;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Feedback Page</h2>

    <div class="feedback-form">
        <form action="submit_feedback.php" method="post">

            <label for="pesan">Your Feedback:</label>
            <textarea name="pesan" rows="4" required></textarea>

            <button type="submit">Submit Feedback</button>
        </form>
    </div>

    <!-- Display Existing Feedback -->
    <div class="feedback-container">
        <?php
        // Include your database connection code (inc_koneksi.php).
        include("inc_koneksi.php");

        // Fetch existing feedback from the database.
        $sql = "SELECT * FROM feedback ORDER BY id DESC";
        $result = mysqli_query($koneksi, $sql);

        // Display each feedback.
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='feedback-item'>";
            echo "<strong>Anon:</strong> " . $row['username'] . "<br>";
            echo "<p>" . $row['pesan'] . "</p>";
            echo "</div>";
        }

        // Close the database connection.
        mysqli_close($koneksi);
        ?>
    </div>
</div>

</body>
</html>
