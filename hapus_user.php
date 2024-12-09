<?php

include 'koneksi.php';

$id = $_GET['id'];

$query_delete = mysqli_query($koneksi, "DELETE FROM user WHERE id_user = '$id'") or die(mysqli_error($koneksi));

if ($query_delete) {
    header("location: tampil_user.php");
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>