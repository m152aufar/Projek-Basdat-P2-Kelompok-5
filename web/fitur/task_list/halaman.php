<?php include("inc_header.php"); ?>

<?php
$sukses = "";
$username_now = $_SESSION['session_username'];
$katakunci = isset($_GET['katakunci']) ? $_GET['katakunci'] : "";

if (isset($_GET['op'])) {
    $op = $_GET['op'];
} else {
    $op = "";
}

// Delete
if ($op == 'delete' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sqlDelete = "DELETE FROM task_list WHERE id = ?";
    $stmt = mysqli_prepare($koneksi, $sqlDelete);
    mysqli_stmt_bind_param($stmt, "i", $id);
    $q1 = mysqli_stmt_execute($stmt);

    if ($q1) {
        $sukses = "Berhasil hapus data";
    }
}

?>
<link rel="icon" type="image/png" href="image/logo1.png" sizes="32x32" />
<h1 class="text-center mt-4">Task List</h1>
<?php
if ($sukses) {
?>
    <div class="alert alert-primary" role="alert">
        <?php echo $sukses ?>
    </div>
<?php
}
?>
<form class="row g-3" method="GET">
    <div class="col-auto">
        <input type="text" class="form-control" placeholder="Masukkan Kata Kunci" name="katakunci" value="<?php echo $katakunci ?>" />
    </div>
    <div class="col-auto">
        <input type="submit" name="cari" value="Cari Tulisan" class="btn btn-secondary" />
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th class="col-1">#</th>
            <th>Mata Kuliah</th>
            <th>Judul Tugas</th>
            <th>Detail Penugasan</th>
            <th>Deadline</th>
            <th>Status</th>
            <th class="col-2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sqltambahan = "";
        $per_halaman = 10;
        if ($katakunci != '') {
            $array_katakunci = explode(" ", $katakunci);
            for ($x = 0; $x < count($array_katakunci); $x++) {
                $sqlcari[] = "(nama_mata_kuliah LIKE '%" . $array_katakunci[$x] . "%' OR judul_tugas LIKE '%" . $array_katakunci[$x] . "%' OR detail_penugasan LIKE '%" . $array_katakunci[$x] . "%')";
            }
            $sqltambahan = " AND " . implode(" OR ", $sqlcari);
        }

        // Read
        $sql1   = "SELECT * FROM task_list WHERE username = ?" . $sqltambahan;
        $stmt = mysqli_prepare($koneksi, $sql1);
        mysqli_stmt_bind_param($stmt, "s", $username_now);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $page   = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $mulai  = ($page > 1) ? ($page * $per_halaman) - $per_halaman : 0;
        $total  = mysqli_num_rows($result);
        $pages  = ceil($total / $per_halaman);
        $nomor  = $mulai + 1;
        $sql1   = $sql1 . " ORDER BY id ASC LIMIT $mulai, $per_halaman";

        $stmt = mysqli_prepare($koneksi, $sql1);
        mysqli_stmt_bind_param($stmt, "s", $username_now);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while ($r1 = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <td><?php echo $nomor++ ?></td>
                <td><?php echo $r1['nama_mata_kuliah'] ?></td>
                <td><?php echo $r1['judul_tugas'] ?></td>
                <td><?php echo $r1['detail_penugasan'] ?></td>
                <td><?php echo ($r1['deadline'] != '0000-00-00') ? date('Y-m-d', strtotime($r1['deadline'])) : ''; ?></td>
                <td><?php echo $r1['judul_status'] ?></td>
                <td>
                    <a href="halaman_input.php?id=<?php echo $r1['id'] ?>">
                        <span class="badge bg-warning text-dark">Edit</span>
                    </a>
                    <a href="halaman.php?op=delete&id=<?php echo $r1['id'] ?>" onclick="return confirm('Apakah yakin mau menghapus data?')">
                        <span class="badge bg-danger">Delete</span>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<p>
    <a href="halaman_input.php">
        <input type="button" class="btn-primary" value="Buat task" />
    </a>
</p>

<nav aria-label="Page navigaton example">
    <ul class="pagination">
        <?php
        $cari = (isset($_GET['cari'])) ? $_GET['cari'] : "";
        for ($i = 1; $i <= $pages; $i++) {
        ?>
            <li class="page-item">
                <a class="page-link" href="halaman.php?katakunci=<?php echo $katakunci ?>&cari=<?php echo $cari ?>&page=<?php echo $i ?>"><?php echo $i ?></a>
            </li>
        <?php
        }
        ?>
    </ul>
</nav>
