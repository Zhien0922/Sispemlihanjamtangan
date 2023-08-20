<?php
require 'dbcon.php';
require 'session.php';

//recieve the submitted value
if(isset($_POST['submit'])){
    $idpengguna = $_SESSION['idpengguna'];
    $new_id = $_POST['idpengguna'];
    $namapengguna = $_POST['namapengguna'];
    $notel = $_POST['notel'];
    $katalaluan = $_POST['katalaluan'];

    //update the user info
    $update = mysqli_query($conn,"UPDATE pengguna SET
    IDpengguna = '$new_id', NamaPengguna = '$namapengguna', NoTel = '$notel', KataLaluan = '$katalaluan'
    WHERE IDpengguna = '$idpengguna'");
    if($update){
        echo "<script> alert('Maklumat akaun sudah dikemaskini!');</script>";
        $_SESSION['idpengguna'] = $_POST['idpengguna'];
        $_SESSION['namapengguna'] = $_POST['namapengguna'];
        $_SESSION['notel'] = $_POST['notel'];
        $_SESSION['katalaluan'] = $_POST['katalaluan'];
    }else{
        echo "<script> alert('Error!'); '</script>";
    }
}else{
    $conn->close();
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
            <p class="title">Maklumat Akaun Pengguna</p>
            <form class="form" method="POST">

                <!--Input id -->
                <div class="input-group">
                    <label for="">No IC:</label>
                    <input type="text" name="idpengguna" pattern="([0-9]{12})"
                        oninvalid="setCustomValidity('No kad pengenalan hanya boleh 12 digit dan tidak boleh kosong')"
                        oninput="setCustomValidity('')" value="<?php echo $_SESSION['idpengguna'] ?>"
                        maxlength=12>
                </div>

                <!--Input nama-->
                <div class="input-group">
                    <label for="">Nama Pengguna:</label>
                    <input type="text" name="namapengguna" pattern="([A-Za-z]{1,50})"
                        oninvalid="setCustomValidity('Nama tidak boleh kosong')" oninput="setCustomValidity('')"
                        value="<?php echo $_SESSION['namapengguna'] ?>">
                </div>

                <!--Input notel-->
                <div class="input-group">
                    <label for="">Nombor Telefon:</label>
                    <input type="text" name="notel" pattern="([0-9]{10,11})"
                        oninvalid="setCustomValidity('Nombor telefon tidak boleh melebihi 11 digit dan tidak boleh kosong')"
                        oninput="setCustomValidity('')" required value="<?php echo $_SESSION['tel'] ?>">
                </div>

                <!--Input kata laluan-->
                <div class="input-group">
                    <label for="">Kata Laluan:</label>
                    <input type="password" name="katalaluan" pattern="([0-9]{4,8})"
                        oninvalid="setCustomValidity('Kata laluan sekurang-kurangnya 4 digit dan tidak boleh melebihi 8 digit')"
                        oninput="setCustomValidity('')" required value="<?php echo $_SESSION['katalaluan'] ?>">
                </div>

                <button type="submit" name="submit" class="sign">Kemaskini</button>
            </form>
        </div>
</body>
</html>