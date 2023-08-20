<?php
include 'dbcon.php';
include 'header.php';
// Get the username and password from the form
if(isset($_POST['submit'])){
    $id = $_POST['id'];
    $katalaluan = $_POST['katalaluan'];

    // Check the id is admin or user
    $pengguna = mysqli_query($conn,"SELECT * FROM pengguna WHERE IDpengguna = '$id' AND KataLaluan = '$katalaluan'");
    $admin = mysqli_query($conn,"SELECT * FROM admin_ WHERE IDadmin = '$id' AND KataLaluan = '$katalaluan'");

    //User login
    if(mysqli_num_rows($pengguna) > 0){
    $row = mysqli_fetch_assoc($pengguna);

    if($row['IDpengguna'] === $id && $row['KataLaluan'] === $katalaluan){
        session_start();
        echo "<script> alert('Log masuk!');</script>";
        $_SESSION['idpengguna'] = $row['IDpengguna'];
        $_SESSION['namapengguna'] = $row['NamaPengguna'];
        $_SESSION['tel'] = $row['NoTel'];
        $_SESSION['katalaluan'] = $row['KataLaluan'];
        echo "<script> window.location = 'Pindex.php';</script>";

    }else{
        echo "<script> alert('Salah ID atau kata laluan!');
            window.location = 'index.php'</script>";
    }

    }elseif(mysqli_num_rows($admin) > 0){
        //admin login
        $row = mysqli_fetch_assoc($admin);
        if($row['IDadmin'] === $id && $row['KataLaluan'] === $katalaluan){
            session_start();
            echo "<script> alert('Log masuk!');
                window.location = 'Aindex.php'</script>";
            $_SESSION['idadmin'] = $row['IDadmin'];
            $_SESSION['namaadmin'] = $row['NamaAdmin'];
            $_SESSION['katalaluan'] = $row['KataLaluan'];

        }else{
            echo "<script> alert('Salah ID atau kata laluan!');
                window.location = 'index.php'</script>";
        }
    }else{
        echo "<script> alert('Salah ID atau kata laluan!');
            window.location = 'index.php'</script>";
    }

}else{
$conn->close();
}
?>

<html>

<head>
    <title> Sistem Pemilihan Jam Tangan </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="index.css" rel="stylesheet" type="text/css">
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
        <!--Login form-->
        <div class="form-container">

            <p class="title">Log Masuk</p>
            <form class="form" method="POST">

                <!--No IC-->
                <div class="input-group">
                    <label for="idpengguna">No IC:</label>
                    <input type="text" pattern="([0-9]{12})"
                        oninvalid="setCustomValidity('No kad pengenalan hanya boleh 12 digit dan tidak boleh kosong')"
                        oninput="setCustomValidity('')" required placeholder="No kad pengenalan tanpa -"
                        name="id" id="id">
                </div>

                <!--Katalaluan-->
                <div class="input-group">
                    <label for="katalaluan">Kata Laluan:</label>
                    <input type="password" pattern="([0-9]{4,8})"
                        oninvalid="setCustomValidity('Kata laluan sekurang-kurangnya 4 digit dan tidak boleh melebihi 8 digit')"
                        oninput="setCustomValidity('')" required placeholder="12345678" name="katalaluan"
                        id="katalaluan" maxlength="8">
                </div>

                <button type="submit" name="submit" class="sign">Log Masuk</button>
                <p class="signup">Tiada akaun lagi? <a href="daftar.php">Daftar</a></p>
            </form>
        </div>
    </center>
</body>

</html>