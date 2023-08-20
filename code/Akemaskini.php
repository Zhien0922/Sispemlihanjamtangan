<?php
require 'dbcon.php';
require 'session.php';

if(isset($_POST['kemaskini'])){
    $idjt = $_SESSION['idjt'];
    $namajt = $_POST['namajt'];
    $idjenama = $_POST['idjenama'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

    $update = mysqli_query($conn,"UPDATE jamtangan SET
    NamaJamTangan = '$namajt', IDjenama = '$idjenama', Harga = '$harga', Gambar = '$gambar' WHERE IDjamTangan = '$idjt'");
    if($update){
        echo "<script> alert('Maklumat sudah dikemaskini!');
        window.location = 'AutilitiProduk.php'</script>";
    }else{
        echo "<script> alert('Error!'); </script>";
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
    <h2>Kemaskini Produk</h2>
    <div class="all-form">
        <div class="form-container">
            <form class="form" method="post">

                <!--idjt-->
                <div class="input-group">
                    <label for="idjamtangan">ID Jam Tangan:
                        <?php echo $_SESSION['idjt']?>
                    </label>
                </div>

                <!--namajt-->
                <div class="input-group">
                    <label for="namajamtangan">Nama:</label>
                    <input type="text" name="namajt" value="<?php echo $_SESSION['namajt']?>" required>
                </div>

                <!--Jenama-->
                <div class="input-group">
                    <label for="jenama">Jenama:</label>
                    <select name="idjenama" required>
                        <option value="">-- Pilih Jenama --</option>
                        <?php
                //Select table jenama
                $sqljenama = mysqli_query($conn, "SELECT * FROM jenama");
                if(mysqli_num_rows($sqljenama) > 0){
                while($senarai_jenama = mysqli_fetch_assoc($sqljenama)){
                ?>
                        <option value="<?php echo $senarai_jenama['IDjenama'];?>">
                            <?php echo $senarai_jenama['Jenama'];?>
                        </option>
                        <?php
            }
        }
    ?>
                    </select>
                </div>

                <!--harga-->
                <div class="input-group">
                    <label for="harga">Harga (RM):</label>
                    <input type="text" name="harga" value="<?php echo $_SESSION['harga']?>" required>
                </div>

                <!--gambar-->
                <div class="input-group">
                    <label for="gambar">Gambar:</label>
                    <img class="p" src="<?php echo $_SESSION['gambar'];?>" alt="preview">
                    <input type="file" name="gambar" required>
                </div>

                <button type="submit" name="kemaskini" class="sign">Kemaskini</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($conn);
?>