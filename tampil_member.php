<?php 
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambah Transaksi</title>
</head>
<body>
    <h2>Pemrograman 3 2024</h2>
    <br>
    <a href="index.php">Kembali</a>
    <br>
    <br>
    <a href="tambah_member.php">+ Tambah member</a>
    <br>
    <table border="1">
        <tr>
            <th>id member</th>
            <th>kode member</th>
            <th>Nama member</th>
            <th>Level</th>
            <th>Opsi</th>
        </tr>
        <?php
        include 'koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM member");
        while($d = mysqli_fetch_array($data)){
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $d['id_member'];?></td>
            <td><?php echo $d['nama_member'];?></td>
            <td><?php echo $d['level'];?></td>
            <td>
                <?php
                // Tampilkan opsi Edit dan Hapus berdasarkan level user yang sedang login
                if ($_SESSION['level'] == 0) {
                    // Level 0 dapat mengedit dan menghapus
                    echo '<a href="edit_transaksi.php?id=' . $d['id_member'] . '">Edit</a>';
                    echo '<a href="hapus_transaksi.php?id=' . $d['id_member'] . '">Hapus</a>';
                } elseif ($_SESSION['level'] == 1) {
                    // Level 1 dapat mengedit dan menghapus
                    echo '<a href="edit_transaksi.php?id=' . $d['id_member'] . '">Edit</a>';
                    echo '<a href="hapus_transaksi.php?id=' . $d['id_member'] . '">Hapus</a>';
                } elseif ($_SESSION['level'] == 2) {
                    // Level 2 tidak dapat mengedit dan menghapus
                    echo 'Tidak diizinkan';
                }elseif ($_SESSION['level'] == 3) {
                // Level 1 dapat mengedit dan menghapus
                echo '<a href="edit_barang.php?id=' . $d['id_member'] . '">Edit</a>';
                echo '<a href="hapus_barang.php?id=' . $d['id_member'] . '">Hapus</a>';
            }elseif ($_SESSION['level'] == 4) {
                // Level 1 dapat mengedit dan menghapus
                echo '<a href="edit_barang.php?id=' . $d['id_member'] . '">Edit</a>';
                echo '<a href="hapus_barang.php?id=' . $d['id_member'] . '">Hapus</a>';
            }
                ?>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
