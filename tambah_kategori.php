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
    <title>Tambah Kategori</title>
</head>
<?php
    //Koneksi ke database
    include 'koneksi.php';
    //Menangkap data yang dikirim dari form
    if(!empty($_POST['save'])){
        $Nama = $_POST['nama_kategori'];
        $Diskon = $_POST['diskon'];
        //menginput data ke database
        $a = mysqli_query($koneksi,"insert into kategori values('','$Nama','$Diskon')");
        if($a){
            //mengalihkan ke halaman kembali
            header("location:tambah_kategori.php");
        }else{
            echo mysqli_error($koneksi);
        }
    }
?>
<body>
    <h2>Pemograman 3 2024</h2>
    <br>
    <a href="tampil_kategori.php">Kembali</a>
    <br>
    <h3>TAMBAH DATA KATEGORI</h3>
    <form method="POST">
        <table>
            <tr>
                <td>Nama Kategori</td>
                <td><input type="text" name="nama_kategori"></td>
            </tr>
            <tr>
                <td>Diskon</td>
                <td><input type="text" name="diskon"></td>
            </tr>
            
            <tr>
                <td></td>
                <td><input type="submit" name="save"></td>
            </tr>
        </table>
    </form>
</body>
</html>