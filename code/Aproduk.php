<?php
require 'dbcon.php';
require 'session.php';
?>

<html>
<head>
<title>Sistem Pemilihan Jam Tangan</title>
<link href="style.css" rel="stylesheet" type="text/css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="menu">
    <h2> Senarai Produk<h2>
    <div class="pilihjenama">
        <form class="add" method="post">
            <?php
        //Select table jenama
        $sqljenama=mysqli_query($conn,"SELECT * FROM jenama");
        if(mysqli_num_rows($sqljenama) > 0){
            if($senarai_jenama = mysqli_fetch_assoc($sqljenama)){

            foreach($sqljenama as $senarai_jenama){
                ?>
            <input type="radio" name="idjenama" required
                value="<?php echo $senarai_jenama['IDjenama'];?>">
            <input type="hidden" name="jenama" value="<?php echo $senarai_jenama['Jenama'];?>">
            <label for="">
                <?php echo $senarai_jenama['Jenama'];?>
            </label><br>
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
    $jamtangan = mysqli_query($conn, "SELECT * FROM jamtangan WHERE IDjenama = '$cariJenama' ORDER BY Harga ASC");
  } else {

    // No brand has been selected, select all data from the table
    $jamtangan = mysqli_query($conn, "SELECT * FROM jamtangan");
  }

  if (mysqli_num_rows($jamtangan) > 0) {
    while ($row = mysqli_fetch_assoc($jamtangan)) {
      // Display the watch information
        ?>
        <div class="content">
            <form action="" method="POST">
                <img class="p" src="<?php echo $row['Gambar'];?>" alt="jt">
                <h3 class="w"><?php echo $row['NamaJamTangan'];?></h3>
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
                <h5 class="j">RM <?php echo $row['Harga'];?></h5>

            </form>

        </div>
        <?php
            }
        }
            ?>
    </div>
</body>
</html>
<?php
mysqli_close($conn);
?>