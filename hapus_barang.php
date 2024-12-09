<?php

include 'koneksi.php';

$id = $_GET['id'];

$query_delete = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang = '$id'") or die(mysqli_error($koneksi));

if ($query_delete) {
    header("location: tampil_barang.php");
} else {
    echo "Gagal menghapus data: " . mysqli_error($koneksi);
}
?>