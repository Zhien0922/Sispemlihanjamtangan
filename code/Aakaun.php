<?php
require 'dbcon.php';
require 'session.php';

//Get info from the form
if(isset($_POST['submit'])){
    $idadmin = $_SESSION['idadmin'];
    $new_id = $_POST['idadmin'];
    $namaadmin = $_POST['namaadmin'];
    $katalaluan = $_POST['katalaluan'];

//Update the info into the database
    $update = mysqli_query($conn,"UPDATE admin_ SET
    IDadmin = '$new_id', NamaAdmin = '$namaadmin', KataLaluan = '$katalaluan' WHERE IDadmin = '$idadmin'");
    if($update){
        echo "<script> alert('Akaun sudah dikemaskini!');</script>";
        $_SESSION['idadmin'] = $_POST['idadmin'];
        $_SESSION['namaadmin'] = $_POST['namaadmin'];
        $_SESSION['katalaluan'] = $_POST['katalaluan'];
    }else{
        echo "<script> alert('Error!'); '</script>";
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
    <h2>Kemaskini Akaun</h2>
    <div class="all-form">
        <div class="form-container">
            <p class="title">Maklumat Akaun Admin</p>
            <form class="form" method="POST">

                <!--Input id admin-->
                <div class="input-group">
                    <label for="idadmin">No IC:</label>
                    <input type="text" name="idadmin" pattern="([0-9]{12})"
                        oninvalid="setCustomValidity('No kad pengenalan hanya boleh 12 digit dan tidak boleh kosong')"
                        oninput="setCustomValidity('')" value="<?php echo $_SESSION['idadmin']?>">
                </div>

                <!--Input nama admin-->
                <div class="input-group">
                    <label for="namaadmin">Nama Admin:</label>
                    <input type="text" name="namaadmin" pattern="([A-Za-z]{1,50})"
                        oninvalid="setCustomValidity('Nama tidak boleh dikosong')" oninput="setCustomValidity('')"
                        value="<?php echo $_SESSION['namaadmin']?>">
                </div>

                <!--Input kata laluan-->
                <div class="input-group">
                    <label for="katalaluan">Kata Laluan:</label>
                    <input type="password" name="katalaluan" pattern="([0-9]{4,8})"
                        oninvalid="setCustomValidity('Kata laluan sekurang-kurangnya 4 digit dan tidak boleh melebihi 8 digit')"
                        oninput="setCustomValidity('')" value="<?php echo $_SESSION['katalaluan']?>">
                </div>

                <button type="submit" name="submit" class="sign">Kemaskini</button>
            </form>
        </div>
    </div>
</body>

</html>
<?php
mysqli_close($conn);
?>