<?php
require 'dbcon.php';
require 'session.php';

// Get the product info from the form
if(isset($_POST['tambah'])){
    $namajt = $_POST['namajt'];
    $idjenama = $_POST['idjenama'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar'];

  // Check if the jam tangan is already had
    $sql = "SELECT * FROM jamtangan WHERE NamaJamTangan = '$namajt'";
    $result = $conn->query($sql);

    if(mysqli_num_rows($result) > 0){
        echo "<script> alert('Produk tersebut sudah ada!');
            window.location = 'Atambah.php'</script>";
    }else{
        // Insert the new jam tangan into the database
        $sql2 = "INSERT INTO jamtangan (NamaJamTangan, IDjenama, Harga, Gambar) VALUES ('$namajt', '$idjenama', '$harga', '$gambar')";
        if (mysqli_query($conn, $sql2)) {
            echo "<script> alert('Produk sudah ditambah!');</script>";
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
    <h2>Tambah Produk</h2>
    <div class="all-form">
        <div class="form-container">
            <form class="form" method="POST">

                <!--NamaJamtangan-->
                <div class="input-group">
                    <label for="namajamtangan">Nama:</label>
                    <input type="text" name="namajt" placeholder="Jam Tangan" required>
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
                while($senarai_jenama = mysqli_fetch_assoc($sqljenama)){ ?>
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
                    <input type="text" name="harga" placeholder="00.00" required>
                </div>

                <!--gambar-->
                <div class="input-group">
                    <label for="gambar">Gambar:</label>
                    <input type="file" name="gambar" required>
                </div>
                <button class="sign" type="submit" name="tambah">Tambah</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($conn);
?>