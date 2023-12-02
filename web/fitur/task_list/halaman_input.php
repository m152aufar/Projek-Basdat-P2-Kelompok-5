<?php include("inc_header.php"); ?>

<?php
$id               = "";
$nama_mata_kuliah = "";
$judul_tugas      = "";
$detail_penugasan = "";
$deadline         = "";
$judul_status     = "";
$error            = "";
$sukses           = "";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    $id = "";
}

if ($id != "") {
    $sql1 = "SELECT * FROM task_list WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sql1);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        $nama_mata_kuliah = $row['nama_mata_kuliah'];
        $judul_tugas      = $row['judul_tugas'];
        $detail_penugasan = $row['detail_penugasan'];
        $deadline         = $row['deadline'];
        $judul_status     = $row['judul_status'];
    } else {
        $error = "Data tidak ditemukan";
    }
}

if (isset($_POST['simpan'])) {
    $nama_mata_kuliah = $_POST['nama_mata_kuliah'];
    $judul_tugas      = $_POST['judul_tugas'];
    $detail_penugasan = $_POST['detail_penugasan'];
    $deadline         = $_POST['deadline'];
    $judul_status     = $_POST['judul_status'];
    $username_now     = $_SESSION['session_username'];

    if ($nama_mata_kuliah == '' or $judul_tugas == '') {
        $error = "Silahkan masukkan semua data, yaitu data mata kuliah dan judul tugas.";
    }

    if (empty($error)) {
        // Insert or update data into task_list table
        if ($id != "") {
            $sql1 = "UPDATE task_list SET nama_mata_kuliah=?, judul_tugas=?, detail_penugasan=?, deadline=?, judul_status=? WHERE id=?";
            $stmt = mysqli_prepare($koneksi, $sql1);
            mysqli_stmt_bind_param($stmt, "sssssi", $nama_mata_kuliah, $judul_tugas, $detail_penugasan, $deadline, $judul_status, $id);
        } else {
            // Insert new data into task_list
            $sql1 = "INSERT INTO task_list (nama_mata_kuliah, judul_tugas, detail_penugasan, deadline, judul_status, username) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($koneksi, $sql1);
            mysqli_stmt_bind_param($stmt, "ssssss", $nama_mata_kuliah, $judul_tugas, $detail_penugasan, $deadline, $judul_status, $username_now);
        }

        if (mysqli_stmt_execute($stmt)) {
            $sukses = "Sukses memasukkan data";
        } else {
            $error = "Gagal memasukkan data: " . mysqli_error($koneksi);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<h1 class="text-center mt-4">New Task</h1>
<div class="mb-3 row">
    <p>
        <a href="halaman.php">
            <input type="button" class="btn-primary" value="Kembali ke Task List" />
        </a>
    </p>
</div>
<?php if ($error) { ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error ?>
    </div>
<?php } ?>
<?php if ($sukses) { ?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php } ?>
<form action="" method="post">
    <div class="mb-3">
        <label for="nama_mata_kuliah" class="form-label">Mata Kuliah</label>
        <select class="form-select" id="nama_mata_kuliah" name="nama_mata_kuliah">
            <?php
            $sqlMataKuliah = "SELECT nama_mata_kuliah FROM mata_kuliah";
            $resultMataKuliah = mysqli_query($koneksi, $sqlMataKuliah);

            while ($rowMataKuliah = mysqli_fetch_assoc($resultMataKuliah)) {
                $selected = ($nama_mata_kuliah == $rowMataKuliah['nama_mata_kuliah']) ? 'selected' : '';
                echo "<option value='{$rowMataKuliah['nama_mata_kuliah']}' $selected>{$rowMataKuliah['nama_mata_kuliah']}</option>";
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="judul_tugas" class="form-label">Judul Tugas</label>
        <input type="text" class="form-control" id="judul_tugas" value="<?php echo $judul_tugas ?>" name="judul_tugas">
    </div>
    <div class="mb-3">
        <label for="detail_penugasan" class="form-label">Detail Penugasan</label>
        <textarea name="detail_penugasan" class="form-control" id="summernote"><?php echo $detail_penugasan ?></textarea>
    </div>
    <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" class="form-control" id="deadline" value="<?php echo $deadline ?>" name="deadline">
    </div>

    <div class="mb-3">
        <label for="judul_status" class="form-label">Status</label>
        <input type="text" class="form-control" id="judul_status" value="<?php echo $judul_status ?>" name="judul_status">
    </div>
    <div class="mb-3">
        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
    </div>
</form>

<?php include("inc_footer.php"); ?>
