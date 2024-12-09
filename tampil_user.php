
<?php 
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:index.php");
    exit();
}

include 'koneksi.php';

$loggedInUserLevel = isset($_SESSION['level']) ? $_SESSION['level'] : null; // Ambil level user yang sedang login

$no = 1;
$data = mysqli_query($koneksi, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html>
    <head>
        <title>pemograman3.com</title>
</head>

<body>
    <h2>pemograman 3 2024</h2>
    <br>
    <a href="tambah_user.php">+ TAMBAH USER</a>
    <br>
    <table border="1">
        <tr>
            <th>id</th>
            <th>nama</th>
            <th>Password</th>
            <th>level</th>
            <th>status</th>
            <th>OPSI</th>
</tr>
<?php
include 'koneksi.php';
$no = 1;
$data = mysqli_query($koneksi,"select * from user");
while($d = mysqli_fetch_array($data)){
    ?>
    <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['nama']; ?></td>
        <td><?php echo $d['password']; ?></td>
        <td><?php echo $d['level']; ?></td>
        <td><?php echo $d['status']; ?></td>
        <td>
           <?php
// Tampilkan opsi Edit dan Hapus berdasarkan level user yang sedang login
if ($loggedInUserLevel == 0) {
    // Level 0 dapat mengedit dan menghapus semua level
    echo '<a href="edit_user.php?id=' . $d['id_user'] . '">EDIT</a>';
    echo '<a href="hapus_user.php?id=' . $d['id_user'] . '">HAPUS</a>';
} elseif ($loggedInUserLevel == 1) {
    // Level 1 dapat mengedit dan menghapus semua level
    echo '<a href="edit_user.php?id=' . $d['id_user'] . '">EDIT</a>';
    echo '<a href="hapus_user.php?id=' . $d['id_user'] . '">HAPUS</a>';
    
} elseif ($loggedInUserLevel == 2) {
    // Level 2 tidak dapat mengedit dan menghapus
    echo 'Tidak diizinkan';

}elseif ($loggedInUserLevel == 3) {
    // Level 3 dapat mengedit dan menghapus semua level kecuali level 0 dan level 4
    if ($d['level'] == 0 || $d['level'] == 4) {
        echo 'Tidak diizinkan';
    }  if ($d['level'] == 2 || $d['level'] == 3) {
        echo 'Tidak diizinkan';
    } 


}elseif ($loggedInUserLevel == 4) {
    // Level 3 dapat mengedit dan menghapus semua level kecuali level 0 dan level 4
    if ($d['level'] == 0 || $d['level'] == 3) {
        echo 'Tidak diizinkan';
    } if ($d['level'] == 2 || $d['level'] == 4) {
         echo 'tidak diizinkan';
    }
}

?>

<?php
}
?>
</table>
        <br>  
        <a href="index.php">Kembali</a>
        <br>
</body>
</html>
