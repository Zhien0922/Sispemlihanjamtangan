<?php
require 'dbcon.php';
include 'header.php';
// Get the username and password from the form
if(isset($_POST['submit'])){
    $idpengguna = $_POST['idpengguna'];
    $namapengguna = $_POST['namapengguna'];
    $tel = $_POST['tel'];
    $katalaluan = $_POST['katalaluan'];

  // Check if the username or password is already taken
    $sql = mysqli_query($conn, "SELECT * FROM pengguna WHERE IDpengguna = '$idpengguna' OR KataLaluan = '$katalaluan'");
    //$sql2 = mysqli_query($conn, "SELECT * FROM admin_ WHERE IDadmin = '$idpengguna'");

    if(mysqli_num_rows($sql) > 0){
        echo "<script> alert('ID atau kata laluan sudah diambil!');
            window.location = 'Pdaftar.php'</script>";

    }else{
        // Insert the new user into the database
        $sql3 = "INSERT INTO pengguna (IDpengguna, NamaPengguna, NoTel, KataLaluan)
        VALUES ('$idpengguna', '$namapengguna', '$tel', '$katalaluan')";
        if (mysqli_query($conn, $sql3)) {
            echo "<script> alert('Pendaftaran sudah berjaya!');
                window.location = 'index.php'</script>";
        }
    }

    if(mysqli_num_rows($sql2) > 0){
        echo "<script> alert('ID atau kata laluan sudah diambil!');
            window.location = 'Pdaftar.php'</script>";
    }else{
        // Insert the new user into the database
        $sql3 = "INSERT INTO pengguna (IDpengguna, NamaPengguna, NoTel, KataLaluan)
        VALUES ('$idpengguna', '$namapengguna', '$tel', '$katalaluan')";
            if (mysqli_query($conn, $sql3)) {
                echo "<script> alert('Pendaftaran sudah berjaya!');
                    window.location = 'index.php'</script>";
            }
    }

}else{
    $conn->close();
}
?>

<html>

<head>
    <title> Sistem Pemilihan Jam Tangan </title>
    <link href="index.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <!--Change background-->
    <div class="theme">
        <button class="action" id="bgSwitch">Tukar Warna</button>
    </div>
    <script>
        const bgSwitch = document.getElementById("bgSwitch");
        const body = document.querySelector("body");

        bgSwitch.addEventListener("click", () => {
            body.style.backgroundColor = getRandomColor();
        });

        function getRandomColor() {
            const letters = "0123456789ABCDEF";
            let color = "#";
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>
    <center>
    <!--Sign up form-->
    <div class="form-container">
        <p class="title">Daftar</p>
        <form class="form" method="POST">
            <!--IDpengguna-->
            <div class="input-group">
                <label for="idpengguna">No IC:</label>
                <input type="text" pattern="([0-9]{12})"
                    oninvalid="setCustomValidity('No kad pengenalan hanya boleh 12 digit dan tidak boleh kosong')"
                    oninput="setCustomValidity('')" required placeholder="No kad pengenalan tanpa -"
                    name="idpengguna"id="idpengguna" maxlength=12>
            </div>
            <!--Nama Pengguna-->
            <div class="input-group">
                <label for="namapengguna">Nama Pengguna:</label>
                <input type="text" pattern="([A-Za-z]{1,50})"
                    oninvalid="setCustomValidity('Nama tidak boleh mengandungi nombor')"
                    oninput="setCustomValidity('')" required placeholder="Andy"
                    name="namapengguna" id="namapengguna" maxlength=50>
            </div>
            <!--Notel-->
            <div class="input-group">
                <label for="tel">Nombor Telefon:</label>
                <input type="text" pattern="([0-9]{10,11})"
                    oninvalid="setCustomValidity('Nombor telefon tidak boleh melebihi 11 digit dan tidak boleh kosong')"
                    oninput="setCustomValidity('')"required placeholder="01112345678"
                    name="tel" id="tel">
            </div>
            <!--Katalaluan-->
            <div class="input-group">
                <label for="katalaluan">Kata Laluan:</label>
                <input type="password" pattern="([0-9]{4,8})"
                    oninvalid="setCustomValidity('Kata laluan sekurang-kurangnya 4 digit dan tidak boleh melebihi 8 digit')"
                    oninput="setCustomValidity('')" required placeholder="12345678"
                    name="katalaluan" id="katalaluan" maxlength="8">
            </div>
            <button type="submit" name="submit" class="sign">Daftar</button>
            <p class="signup">Sudah ada akaun? <a href="index.php">Log Masuk</a></p>
        </form>
    </div>
    </center>
</body>

</html>