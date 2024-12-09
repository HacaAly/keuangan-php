<?php 
session_start();
if(!isset($_SESSION['session_username'])){
    header("location:index.php");
    exit();
}
include 'koneksi.php';

$query = "SELECT
    m.nama_member AS Member,
    m.level AS Level,
    CASE
        WHEN m.level = 'Platinum' THEN '15%'
        WHEN m.level = 'Gold' THEN '10%'
        WHEN m.level = 'Silver' THEN '5%'
        ELSE '0%'
    END AS `Diskon Member`,
    CASE
        WHEN total_pembelian > 100000 THEN '10%'
        ELSE '0%'
    END AS `Diskon Barang`,
    total_pembelian AS `Total Pembelian`,
    (
        CASE
            WHEN m.level = 'Platinum' THEN total_pembelian * 0.15
            WHEN m.level = 'Gold' THEN total_pembelian * 0.10
            WHEN m.level = 'Silver' THEN total_pembelian * 0.05
            ELSE 0
        END
    ) +
    (
        CASE
            WHEN total_pembelian > 100000 THEN total_pembelian * 0.10
            ELSE 0
        END
    ) AS `Total Diskon`,
    total_pembelian - 
    (
        CASE
            WHEN m.level = 'Platinum' THEN total_pembelian * 0.15
            WHEN m.level = 'Gold' THEN total_pembelian * 0.10
            WHEN m.level = 'Silver' THEN total_pembelian * 0.05
            ELSE 0
        END
    ) -
    (
        CASE
            WHEN total_pembelian > 100000 THEN total_pembelian * 0.10
            ELSE 0
        END
    ) AS `Total Transaksi`
FROM
    member m
JOIN
    Penjualan j ON m.nama_member = j.Nama_Pelanggan
JOIN (
    SELECT
        penjualan_id,
        SUM(total) AS total_pembelian
    FROM
        transaksi
    GROUP BY
        penjualan_id
) t ON j.ID_Penjualan = t.penjualan_id
";
$result = $koneksi->query($query);

if (!$result) {
    die("Error pada query: " . $koneksi->error);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hasil Transaksi</title>
</head>
<body>
    <h1>Hasil Transaksi</h1>
    <br>
    <a href="index.php">KEMBALI</a>
    <br/>
    <table border="1">
        <tr>
            <th>Member</th>
            <th>Level</th>
            <th>Diskon Member</th>
            <th>Diskon Barang</th>
            <th>Total Pembelian</th>
            <th>Total Diskon</th>
            <th>Total Transaksi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['Member']}</td>";
                echo "<td>{$row['Level']}</td>";
                echo "<td>{$row['Diskon Member']}</td>";
                echo "<td>{$row['Diskon Barang']}</td>";
                echo "<td>{$row['Total Pembelian']}</td>";
                echo "<td>{$row['Total Diskon']}</td>";
                echo "<td>{$row['Total Transaksi']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Tidak ada data transaksi.</td></tr>";
        }
        $koneksi->close();
        ?>
    </table>
</body>
</html>
