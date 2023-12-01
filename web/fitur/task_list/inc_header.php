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
    <link rel="icon" type="image/png" href="image/logo1.png" sizes="32x32">
    <title>Task List</title>
    <link rel="stylesheet" href="css/apaweh.css">

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <link href="../css/summernote-image-list.min.css">
    <script src="../js/summernote-image-list.min.js"></script>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

    <style>
        .image-list-content .col-lg-3 {
            width: 100%;
        }

        .image-list-content img {
            float: left;
            width: 20%
        }

        .image-list-content p {
            float: left;
            padding-left: 20px
        }

        .image-list-item {
            padding: 10px 0px 10px 0px
        }
    </style>
</head>

<body>
    <header>
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
    </header>
    <main>