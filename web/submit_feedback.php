<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code (inc_koneksi.php).
    include("inc_koneksi.php");

    // Escape user inputs for security.
    $pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);

    // Insert new feedback into the database.
    $insert_query = "INSERT INTO feedback (pesan, tanggal) VALUES ('$pesan', CURDATE())";
    $result = mysqli_query($koneksi, $insert_query);

    if ($result) {
        echo "Feedback submitted successfully!";
        echo '<br><br>';
        echo '<a href="http://localhost/web/fitur/review/feedbacks.php">Kembali ke Halaman Feedback</a>';
    } else {
        echo "Error: " . mysqli_error($koneksi);
    }

    // Close the database connection.
    mysqli_close($koneksi);
} else {
    // Redirect to the feedback page if accessed directly without form submission.
    header("Location: feedback.php");
    exit();
}
?>
