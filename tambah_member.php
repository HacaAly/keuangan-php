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
    <title>Tambah Member</title>
</head>
<?php
    //koneksi database
    include 'koneksi.php';
    //menangkap data yang dikirim dari form
    if(!empty($_POST['save'])){
        
        $Kode = $_POST['kode_member'];
        $Nama = $_POST['nama_member'];
        $level = $_POST['level'];
        //menginput data ke database
        $a = mysqli_query($koneksi,"insert into member values('','$Kode','$Nama','$level')");
        if($a){
            //mengalihkan ke halaman kembali
            header("location:tampil_member.php");
        }else{
            echo mysqli_error($koneksi);
        }
    }
?>
<body>
    <h2>Pemograman 3 2024</h2>
    <br>
    <a href="tampil_member.php">Kembali</a>
    <br>
    <h3>TAMBAH DATA MEMBER</h3>
    <form method="POST">
        <table>
            
            <tr>
                <td>Kode member</td>
                <td><input type="number" name="kode_member"></td>
            </tr>
            <tr>
                <td>Nama member</td>
                <td><input type="text" name="nama_member"></td>
            </tr>
 <tr>
            <td>level</td>
            <td><select name="level">
                <option value="">-----pilih</option>
                <option value="Gold">Gold</option>
                <option value="Silver">Silver</option>
                <option value="Platinum">Platinum</option>
                
</select>
</td>
</tr>       
            <tr>
                <td></td>
                <td><input type="submit" name="save"></td>
            </tr>
        </table>
    </form>
</body>
</html>