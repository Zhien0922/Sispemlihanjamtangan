<?php
require 'dbcon.php';
require 'session.php';

if(isset($_POST['padam'])){
    $idjamtangan = $_POST['idjt'];
    $sql = mysqli_query($conn,"SELECT * FROM jamtangan WHERE IDjamTangan = '$idjamtangan'");

    if(mysqli_num_rows($sql) > 0){
        $delete = mysqli_query($conn,"DELETE FROM `jamtangan` WHERE `jamtangan`.`IDjamTangan` = $idjamtangan");
        echo "<script> alert('Sudah dipadam!');
            window.location = 'AutilitiProduk.php'</script>";
    }else{
        echo "<script> alert('Error!');
            window.location = 'AutilitiProduk.php'</script>";
    }
    }
    if(isset($_POST['kemaskini'])){
        $idjamtangan = $_POST['idjt'];
        $_SESSION['jenama'] = $_POST['jenama'];
        $sql = mysqli_query($conn, "SELECT * FROM jamtangan WHERE IDjamTangan = '$idjamtangan'");

    if(mysqli_num_rows($sql) > 0){
        echo "<script> window.location = 'Akemaskini.php'</script>";
    session_start();
    $row = mysqli_fetch_assoc($sql);

    if($row['IDjamTangan'] === $idjamtangan){
        $_SESSION['idjt'] = $row['IDjamTangan'];
        $_SESSION['namajt'] = $row['NamaJamTangan'];
        $_SESSION['harga'] = $row['Harga'];
        $_SESSION['idjenama'] = $row['IDjenama'];
        $_SESSION['gambar'] = $row['Gambar'];
    }

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
    <h2>Kemaskini/Padam Produk</h2>
    <form method="post">
        <div class="search-grp">
        <input class="search" type="text" name="search" oninvalid="setCustomValidity('Masukkan kata kunci')"
            oninput="setCustomValidity('')" required placeholder="Kata Kunci">
        <input class="search-btn" type="submit" name="cari" value="Cari">
        </div>
    </form>
    <div class="tablesection">
        <table>
            <thead>
                <tr>
                    <th>Bil</th>
                    <th>Jam Tangan</th>
                    <th>Nama</th>
                    <th>ID Jenama</th>
                    <th>Jenama</th>
                    <th>Harga (RM)</th>
                    <th colspan="2" align="center">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <tr>

                    <?php
            if (isset($_POST['cari'])) {
            $cari = mysqli_real_escape_string($conn, $_POST['search']);

            // Execute a query to select data from multiple tables
            $hasil_cari = mysqli_query($conn,"SELECT * FROM jamtangan t1
            JOIN jenama t2 ON t1.IDjenama = t2.IDjenama
            WHERE (t1.NamaJamTangan LIKE '%$cari%' OR t1.Harga LIKE '%$cari%' OR t2.Jenama LIKE '%$cari%')");
            } else {
            // No keyword key in
            $hasil_cari = mysqli_query($conn,"SELECT * FROM jamtangan t1
            JOIN jenama t2 ON t1.IDjenama = t2.IDjenama
            ORDER BY t1.IDjamTangan ASC");
            }
                if(mysqli_num_rows($hasil_cari) > 0){
                    while($row = mysqli_fetch_assoc($hasil_cari)){
            ?>
                    <td>
                        <?php echo $row['IDjamTangan']?>
                    </td>
                    <td><img src="<?php echo $row['Gambar'];?>" alt="jt"></td>
                    <td>
                        <?php echo $row['NamaJamTangan']?>
                    </td>
                    <td>
                        <?php echo $row['IDjenama']?>
                    </td>
                    <td>
                        <?php
                        echo $row['Jenama']?>
                    </td>
                    <td>RM
                        <?php echo $row['Harga']?>
                    </td>
                    <form action="" method="post">
                        <td>
                            <a href="Akemaskini.php" target="content">
                                <button type="submit" class="action" name="kemaskini">Kemaskini</button>
                                <input type="hidden" name="idjt" value="<?php echo $row['IDjamTangan']?>">
                            </a>
                        </td>
                        <td>
                            <button type="submit" class="action" name="padam">Padam</button>
                            <input type="hidden" name="idjt" value="<?php echo $row['IDjamTangan']?>">
                    </form>
                    </td>
                </tr>
                <?php
            };
            };
            ?>

            </tbody>
        </table>
    </div>
</body>

</html>
<?php
mysqli_close($conn);
?>