<?php
require 'dbcon.php';
require 'session.php';

if(isset($_POST['kemaskini'])){
    $oldID = $_SESSION['idjenama2'];
    $idjenama = $_POST['idjenama'];
    $jenama = $_POST['jenama'];

    $update = mysqli_query($conn,"UPDATE jenama SET
    IDjenama = '$idjenama', Jenama = '$jenama' WHERE IDjenama = '$oldID'");
    if($update){
        echo "<script> alert('Sudah dikemaskini!');
        window.location = 'Aimport.php'</script>";
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
    <h2>Kemaskini Jenama</h2>
    <div class="all-form">
        <div class="form-container">
            <form class="form" method="post">

                <!--idjenama-->
                <div class="input-group">
                    <label for="idjenama">ID Jenama:</label>
                    <input type="text" name="idjenama" value="<?php echo $_SESSION['idjenama2']?>">
                </div>
                <!--jenama-->
                <div class="input-group">
                    <label for="jenama">Jenama:</label>
                    <input type="text" name="jenama" value="<?php echo $_SESSION['jenama2']?>">
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