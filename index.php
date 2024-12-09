
<?php 
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:login.php");
    exit();
}
$loggedInUserLevel = isset($_SESSION['level']) ? $_SESSION['level'] : null; // Ambil level user yang sedang login


// Tambahkan pesan selamat datang untuk level 0
$welcomeMessage = '';
if ($_SESSION['level'] == 0) {
    $welcomeMessage = 'Selamat datang, Admin!';
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemograman3.com</title>
</head>
<body>
    <header>
        <h1>MENU PEMOGRAMAN 3</h1>
                <!-- Tampilkan pesan selamat datang untuk level 0 -->
        <p><?php echo $welcomeMessage; ?></p>

    </header>
    <div class="container">
        <div class="contain">
            <?php
            if ($loggedInUserLevel != 2) {
    // Level 0 dapat mengedit dan menghapus semua level
    
            ?>
            <a href="tampil_barang.php">
                <div class="card">
                    <h2>BARANG</h2>
                </div>
            </a>
            
            <a href="tampil_kategori.php">
                <div class="card">
                    <h2>KATEGORI</h2>
                </div>
            </a>
            <a href="tampil_member.php">
                <div class="card">
                    <h2>MEMBER</h2>
                </div>
            </a>
            <a href="tampil_penjualan.php">
                <div class="card">
                    <h2>PENJUALAN</h2>
                </div>
            </a>
                        <a href="tampil_user.php">
                <div class="card">
                    <h2>USER</h2>
                </div>
            </a>
            <a href="view_report.php">
                <div class="card">
                    <h2>VIEW REPORT</h2>
                </div>
            </a>
            <?php
            }
            ?>
            <a href="tampil_transaksi.php">
                <div class="card">
                    <h2>TRANSAKSI</h2>
                </div>
            </a>
            <a href="logout.php">
                <div class="card">
                    <h2>LOGOUT</h2>
                </div>
            </a>
        </div>
    </div>
    <footer>
        Created by Cahya Al Hafiizh
    </footer>
</body>
</html>
