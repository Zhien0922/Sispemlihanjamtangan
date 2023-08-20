<?php
require 'dbcon.php';
require 'session.php';

if (isset($_POST['pilih'])) {
    $idjt = $_POST['idjamtangan'];
    $idpengguna = $_POST['idpengguna'];
    $idadmin = '000000000000';

    // Check if the product already exists in the user's selection
    $result = mysqli_query($conn, "SELECT * FROM pemilihan WHERE IDpengguna = '$idpengguna'
    AND IDjamTangan = '$idjt'");
    if (mysqli_num_rows($result) > 0) {
        // Product already exists, show error message to user
        echo "<script> alert('Produk ini sudah ditambah dalam senarai pilihan anda!');</script>";
    } else {
        // Product doesn't exist, insert into database
        $sel = mysqli_query($conn, "SELECT * FROM jamtangan WHERE IDjamTangan = '$idjt'");
        if (mysqli_num_rows($sel) > 0) {
            $sql = mysqli_query($conn, "INSERT INTO pemilihan (IDpengguna, IDjamTangan, IDadmin)
            VALUES ('$idpengguna', '$idjt', '$idadmin')");
            echo "<script> alert('Berjaya tambah ke pemilihan anda!');</script>";
        } else {
            echo "<script> alert('Ralat! Produk ini tidak wujud.');</script>";
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

<body class="menu">
    <h2>Senarai Produk</h2>
    <div class="container">
        <form action="" method="post">
            <?php
        //Select table jenama
        $sqljenama=mysqli_query($conn,"SELECT * FROM jenama");
        if(mysqli_num_rows($sqljenama) > 0){
            if($senarai_jenama = mysqli_fetch_assoc($sqljenama)){
            foreach($sqljenama as $senarai_jenama){
                ?>
            <label>
                <input type="radio" name="idjenama" required value="<?php echo $senarai_jenama['IDjenama'];?>" <?php
                    if(isset($_POST['idjenama']) && $_POST['idjenama']==$senarai_jenama['IDjenama']) echo 'checked' ;
                    ?>>
                <span>
                    <?php echo $senarai_jenama['Jenama'];?>
                </span>
                <input type="hidden" name="jenama" value="<?php echo $senarai_jenama['Jenama'];?>">
            </label>

            <?php
            }
        }
    }
    ?>
            <center>
                <button class="action" type="submit" name="cari">Cari</button>
            </center>
        </form>
    </div>

    <div class="gallery">
        <?php
    if (isset($_POST['cari'])) {

    // Retrieve the selected ID
    $cariJenama = mysqli_real_escape_string($conn, $_POST['idjenama']);

    // Execute a query to select data from the table where IDjenama matches the selected ID
    $jamtangan = mysqli_query($conn,
    "SELECT * FROM jamtangan WHERE IDjenama = '$cariJenama' ORDER BY Harga ASC");
    } else {

    // No brand has been selected, select all data from the table
    $jamtangan = mysqli_query($conn, "SELECT * FROM jamtangan ORDER BY Harga ASC");
    }

    if (mysqli_num_rows($jamtangan) > 0) {
    while ($row = mysqli_fetch_assoc($jamtangan)) {
      // Display the watch information
        ?>
        <div class="content">
            <form method="POST">
                <img class="p" src="<?php echo $row['Gambar'];?>" alt="jt">
                <h3 class="w">
                    <?php echo $row['NamaJamTangan'];?>
                </h3>
                <h5 class="j">
                    <?php
                        $idjenama = $row['IDjenama'];
                        $sel = mysqli_query($conn,"SELECT * FROM jenama WHERE IDjenama = '$idjenama'");
                        if(mysqli_num_rows($sel) > 0){
                        $jenama = mysqli_fetch_assoc($sel);
                        echo $jenama['Jenama'];
                        }
                ?>
                </h5>
                <h5 class="j">RM
                    <?php echo $row['Harga'];?>
                </h5>

                <input type="hidden" name="idpengguna" value="<?php echo $_SESSION['idpengguna'];?>">
                <input type="hidden" name="idjamtangan" value="<?php echo $row['IDjamTangan'];?>">

                <button class="buy" name="pilih" value="pilih" type="submit">Pilih</button>
            </form>
        </div>
        <?php
    }
            }
        ?>
    </div>
</body>

</html>