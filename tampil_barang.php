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
    <title>Tampil Barang</title>
</head>
<body>
    <h2>Pemograman 3 2024</h2>
    <br>
    <a href="tambah_barang.php">+ Tambah Barang</a>
    <br>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nama Barang</th>
            <th>Kode Barang</th>
            <th>Qty</th>
            <th>Id Kategori</th>
            <th>Harga</th>  
            <th>Opsi</th>          
        </tr>
<?php
    include 'koneksi.php';
    $no = 1;
    $data = mysqli_query($koneksi, "SELECT * FROM barang");

while ($d = mysqli_fetch_array($data)) {
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama_barang']; ?></td>
        <td><?php echo $d['kode_barang']; ?></td>
        <td><?php echo $d['qty']; ?></td>
        <td><?php echo $d['kategori_id']; ?></td>
        <td><?php echo $d['harga']; ?></td>
        <td>
            <?php
            // Tampilkan opsi Edit dan Hapus berdasarkan level pengguna
            if ($_SESSION['level'] == 0) {
                // Level 0 dapat mengedit dan menghapus
                echo '<a href="edit_barang.php?id=' . $d['id_barang'] . '">Edit</a>';
                echo '<a href="hapus_barang.php?id=' . $d['id_barang'] . '">Hapus</a>';
            } elseif ($_SESSION['level'] == 1) {
                // Level 1 dapat mengedit dan menghapus
                echo '<a href="edit_barang.php?id=' . $d['id_barang'] . '">Edit</a>';
                echo '<a href="hapus_barang.php?id=' . $d['id_barang'] . '">Hapus</a>';
              } elseif ($_SESSION['level'] == 2) {
                // Level 2 tidak dapat mengedit dan menghapus
                echo 'Tidak diizinkan';
            } elseif ($_SESSION['level'] == 3) {
                // Level 1 dapat mengedit dan menghapus
                echo '<a href="edit_barang.php?id=' . $d['id_barang'] . '">Edit</a>';
                echo '<a href="hapus_barang.php?id=' . $d['id_barang'] . '">Hapus</a>';
            }elseif ($_SESSION['level'] == 4) {
                // Level 1 dapat mengedit dan menghapus
                echo '<a href="edit_barang.php?id=' . $d['id_barang'] . '">Edit</a>';
                echo '<a href="hapus_barang.php?id=' . $d['id_barang'] . '">Hapus</a>';
            }
            ?>
        </td>
    </tr>
<?php
}
?>

</table>
    <br>  
    <a href="index.php">Kembali</a>
    <br>
</body>
</html>