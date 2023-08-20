<?php
require 'dbcon.php';
require 'session.php';
$idpengguna = $_SESSION['idpengguna'];
if(isset($_POST['padam'])){
    $idjt = $_POST['pemilihan'];
    $sql = mysqli_query($conn,"SELECT * FROM pemilihan WHERE IDjamTangan = '$idjt'");

    if(mysqli_num_rows($sql) > 0){
        $delete = mysqli_query($conn,"DELETE FROM pemilihan WHERE IDjamTangan = '$idjt'");
        echo "<script> alert('Sudah dipadam!');
            window.location = 'Plaporan.php'</script>";
    }else{
        echo "<script> alert('Error!');
            window.location = 'Plaporan.php'</script>";
    }
}
?>

<html>
<head>
<title>Sistem Pemilihan Jam Tangan</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <h2>Senarai Pilihan <?php echo $_SESSION['namapengguna'] ?></h2>
    <center>
    <button onclick="window.print()" class="action">Cetak</button>
    </center>
    <div class="tablesection">
        <table>
            <thead>
                <tr>
                    <th>Bil.</th>
                    <th>ID Jam Tangan</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>ID Jenama</th>
                    <th>Harga (RM)</th>
                    <th>Tindakan</th>
                </tr>
            </thead>
            <tbody>
            <tr>
            <?php
    // Define initial total price, number of products and number of product
    $no = 1;
    $total_price = 0;
    $num_products = 0;

    if (isset($_POST['cari'])) {
        $cari_jenama = $_POST['idjenama'];
        // Execute a query to select data from multiple tables
        $hasil_cari = mysqli_query($conn,"SELECT * FROM pemilihan t1
            JOIN jamtangan t2 ON t1.IDjamTangan = t2.IDjamTangan
            JOIN jenama t3 ON t2.IDjenama = t3.IDjenama
            WHERE (t2.IDjenama='$cari_jenama' AND t1.IDpengguna = '$idpengguna')");

    } else {
        // No keyword key in
        $hasil_cari = mysqli_query($conn,"SELECT * FROM pemilihan t1
            JOIN jamtangan t2 ON t1.IDjamTangan = t2.IDjamTangan
            JOIN jenama t3 ON t2.IDjenama = t3.IDjenama
            WHERE t1.IDpengguna = '$idpengguna'");
    }

    if (mysqli_num_rows($hasil_cari) > 0) {
        while ($pemilihan = mysqli_fetch_assoc($hasil_cari)) {
            // Increment number of products by 1
            $num_products++;

            // Calculate total price by adding the price of each product
            $total_price += $pemilihan['Harga'];
            ?>

    <td>
        <?php echo $no++?>
    </td>
    <td>
        <?php echo $pemilihan['IDjamTangan']?>
    </td>

    <td>
        <img src="<?php echo $pemilihan['Gambar'] ?>" alt="jt">
    </td>

    <td>
    <?php echo $pemilihan['NamaJamTangan'] ?>
    </td>

    <td>
    <?php echo $pemilihan['Jenama'] ?>
    </td>

    <td>
    <?php echo $pemilihan['Harga'] ?>
    </td>

    <td>
        <form action="" method="post">
    <button type="submit" class="action" name="padam">Padam</button>
    <input type="hidden" name="pemilihan" value="<?php echo $pemilihan['IDjamTangan']?>">
    </form>
    </td>
</tr>
                <?php
        }
    }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="4" align="center">Jumlah Bilangan Jam Tangan: <?php echo $num_products?></td>
                    <td colspan="3" align="center">Jumlah Harga: <?php echo number_format($total_price, 2)?> </td>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    
</body>

</html>
<?php

