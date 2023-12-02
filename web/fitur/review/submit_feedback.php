<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code (inc_koneksi.php).
    include("inc_koneksi.php");

    // Escape user inputs for security.
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    // Insert new feedback into the database.
    $insert_query = "INSERT INTO feedback (pesan, tanggal) VALUES ('$pesan', CURDATE())";
    $result = mysqli_query($koneksi, $insert_query);

    // Close the database connection.
    mysqli_close($koneksi);

    // Display feedback submission message.
    echo '<div class="feedback-message-container">';
    if ($result) {
        echo '<h2 class="feedback-success-title">Feedback submitted successfully!</h2>';
        echo '<br>';
        echo '<a href="http://localhost/web/fitur/review/feedbacks.php" class="tbl-biru">Kembali ke Halaman Feedback</a>';
    } else {
        echo '<h2 class="feedback-error-title">Error: ' . mysqli_error($koneksi) . '</h2>';
    }
    echo '</div>';
}


?>
<style>
    .tbl-biru {
        background-color: #fc5185;
        border: none;
        color: #FFFFFF;
        padding: 12px 20px;
        cursor: pointer;
        font-weight: bold;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
        text-decoration: none; 
        display: inline-block; 
        text-align: center; 
    }

    .tbl-biru:hover {
        background-color: #ff6f99;
    }

    .feedback-message-container {
        text-align: center;
        padding: 20px;
        background-color: #f2f2f2;
        border-radius: 10px;
        margin: 20px auto;
        max-width: 400px;
    }

    .feedback-success-title {
        color: #4CAF50;
    }

    .feedback-error-title {
        color: #FF0000;
    }
</style>
