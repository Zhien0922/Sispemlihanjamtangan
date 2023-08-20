<?php
require 'dbcon.php';
require 'session.php';
$selected_jenama = "";
    if (isset($_POST['cari'])) {
        $cari_jenama = $_POST['idjenama'];
        $cari = mysqli_query($conn,"SELECT Jenama FROM jenama WHERE IDjenama = '$cari_jenama'");
        if(mysqli_num_rows($cari) > 0){
            $row = mysqli_fetch_assoc($cari);
            $selected_jenama = $row['Jenama'];
        }

        // Execute a query to select data from multiple tables
        $hasil_cari = mysqli_query($conn,"SELECT * FROM pemilihan t1
            JOIN jamtangan t2 ON t1.IDjamTangan = t2.IDjamTangan
            JOIN jenama t3 ON t2.IDjenama = t3.IDjenama
            JOIN pengguna t4 ON t1.IDpengguna = t4.IDpengguna
            WHERE (t2.IDjenama='$cari_jenama')");

    } else {
        $_SESSION['cari_jenama'] = "";
        // No keyword key in
        $hasil_cari = mysqli_query($conn,"SELECT * FROM pemilihan t1
            JOIN jamtangan t2 ON t1.IDjamTangan = t2.IDjamTangan
            JOIN jenama t3 ON t2.IDjenama = t3.IDjenama
            JOIN pengguna t4 ON t1.IDpengguna = t4.IDpengguna
            ORDER BY t1.IDpengguna ASC");
    }

?>

<html>
<head>
    <title>Sistem Pemilihan Jam Tangan</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<h2 id="selected-jenama">Laporan Pilihan Pengguna Berdasarkan Jenama: <?php echo $selected_jenama ?></h2>

    <div class="all-form">
        <form method="post">
            <!--Jenama-->
            <div class="search-grp">
            <label for="jenama">Pilih Jenama:</label>
            <select name="idjenama" required onchange="updateSelectedJenama()">
                <option value="">-- Pilih Jenama --</option>
                <?php
    //Select table jenama
    $sqljenama = mysqli_query($conn, "SELECT * FROM jenama");
    if(mysqli_num_rows($sqljenama) > 0){
        while($senarai_jenama = mysqli_fetch_assoc($sqljenama)){ ?>
                <option value="<?php echo $senarai_jenama['IDjenama'];?>">
                    <?php echo $senarai_jenama['Jenama'];?>
                </option>
                <?php
            }
        }
    ?>
            </select>
            <input class="search-btn" type="submit" name="cari" value="Cari">
            <!--Print-->
            <button onclick="window.print()" class="search-btn">Cetak</button>
            </div>
        </form>
        </div>

    <!--Table-->
    <div class="tablesection">
        <table>
            <thead>
                <tr>
                    <th>ID Pengguna</th>
                    <th>Nama Pengguna</th>
                    <th>ID Jam Tangan</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Jenama</th>
                    <th>Harga (RM)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
    // Define initial total price and number of products
    $total_user = 0;
    $num_products = 0;
    $users = array();

    if (mysqli_num_rows($hasil_cari) > 0) {
        while ($pemilihan = mysqli_fetch_assoc($hasil_cari)) {
            // Increment number of products by 1
            $num_products++;
            $idpengguna = $pemilihan['IDpengguna'];
            // Check if the user already exists in the array
            if (!in_array($idpengguna, $users)) {
                // Add the user to the array if not already present
                array_push($users, $idpengguna);
            }
            $total_user = count($users);
            ?>

                    <td>
                        <?php echo $pemilihan['IDpengguna']?>
                    </td>
                    <td>
                        <?php echo $pemilihan['NamaPengguna']?>
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
                </tr>
                <?php
                }
                }
                ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" align="center">Jumlah Pengguna:
                        <?php echo $total_user?>
                    </td>
                    <td colspan="4" align="center">Jumlah Bilangan Jam Tangan:
                        <?php echo $num_products?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>
