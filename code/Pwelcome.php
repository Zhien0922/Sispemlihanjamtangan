<?php
require 'session.php';
require 'dbcon.php';
if(isset($_SESSION['idpengguna']) && isset($_SESSION['katalaluan'])){
}
?>

<html>
<title> Sistem Pemilihan Jam Tangan </title>
<link href="style.css" rel="stylesheet" type="text/css" />

<body class="menu">
    <div class="welcome">
        <p class="a">Selamat Datang <?php echo $_SESSION['namapengguna'] ?> </p>
        <p>Sistem ini akan membantu anda memilih jam tangan yang paling ideal.</p>
        <p> Terdapat pelbagai jenema untuk dipilih oleh anda!</p>
        </div>

        <!-- Produk display -->
<div class="gallery">
    <?php
    // Select random 4 data from the table
    $jamtangan = mysqli_query($conn, "SELECT * FROM jamtangan ORDER BY RAND() LIMIT 4");
    if (mysqli_num_rows($jamtangan) > 0) {
        while ($row = mysqli_fetch_assoc($jamtangan)) {
            // Display the watch information
            ?>
            <div class="content">
                <img class="p" src="<?php echo $row['Gambar']; ?>" alt="jt">
                <h3 class="w"><?php echo $row['NamaJamTangan']; ?></h3>
                <h5 class="j">
                    <?php
                    $idjenama = $row['IDjenama'];
                    $sel = mysqli_query($conn, "SELECT * FROM jenama WHERE IDjenama = '$idjenama'");
                    if (mysqli_num_rows($sel) > 0) {
                        $jenama = mysqli_fetch_assoc($sel);
                        echo $jenama['Jenama'];
                    }
                    ?></h5>
                <h5 class="j">RM <?php echo $row['Harga']; ?></h5>
            </div>
            <?php
        }
    }
    ?>
</div>

</body>


</html>