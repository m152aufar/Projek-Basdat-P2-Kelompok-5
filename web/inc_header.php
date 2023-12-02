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
    <title>Task List</title>
    <link rel="stylesheet" href="http://localhost/web/fitur/timer/css/head_timer.css">
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

<body class="container">
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
                    <li class="user-profile">
                        <p1> <?php echo $loggedInUsername; ?></p1>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    </header>
    <main>