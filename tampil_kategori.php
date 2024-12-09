<?php
session_start();
if (!isset($_SESSION['session_username'])) {
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>tampil kategori</title>
</head>

<body>
    <h2>pemrograman 3 2024</h2>
    <br>
    <a href="tambah_kategori.php">+ Tambah Kategori</a>
    <br>
    <table border="1">
        <tr>
            <th>Id</th>
            <th>Nama Kategori</th>
            <th>Diskon</th>
            <th>Opsi</th>
        </tr>
        <?php
        include 'koneksi.php';
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM kategori");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_kategori']; ?></td>
                <td><?php echo $d['diskon']; ?></td>
                <td>
                    <?php
                    // Tampilkan opsi Edit dan Hapus berdasarkan level pengguna
                    if ($_SESSION['level'] == 0) {
                        // Level 0 dapat mengedit dan menghapus
                        echo '<a href="edit_kategori.php?id=' . $d['id_kategori'] . '">Edit</a>';
                        echo '<a href="hapus_barang.php?id=' . $d['id_kategori'] . '">Hapus</a>';
                    } elseif ($_SESSION['level'] == 1) {
                        // Level 1 dapat mengedit dan menghapus
                        echo '<a href="edit_kategori.php?id=' . $d['id_kategori'] . '">Edit</a>';
                        echo '<a href="hapus_barang.php?id=' . $d['id_kategori'] . '">Hapus</a>';
                    } elseif ($_SESSION['level'] == 2) {
                        // Level 2 tidak dapat mengedit dan menghapus
                        echo 'Tidak diizinkan';
                    } elseif ($_SESSION['level'] == 3) {
                // Level 1 dapat mengedit dan menghapus
                        echo '<a href="edit_kategori.php?id=' . $d['id_kategori'] . '">Edit</a>';
                        echo '<a href="hapus_barang.php?id=' . $d['id_kategori'] . '">Hapus</a>';
                }elseif ($_SESSION['level'] == 4) {
                // Level 1 dapat mengedit dan menghapus
                        echo '<a href="edit_kategori.php?id=' . $d['id_kategori'] . '">Edit</a>';
                        echo '<a href="hapus_barang.php?id=' . $d['id_kategori'] . '">Hapus</a>';
                }
            
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
    <a href="index.php">Kembali</a>
    <br>
</body>

</html>
