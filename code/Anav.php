<?php
include 'dbcon.php';
include 'session.php';

?>

<html>

<head>
    <title>Sistem Pemilihan Jam Tangan</title>
    <link href="style.css" rel="stylesheet" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <script>
        // JavaScript code to handle the active state of the navbar
        window.addEventListener('DOMContentLoaded', function () {
            const menuItems = document.querySelectorAll('nav ul li a');
            menuItems.forEach(function (menuItem) {
                menuItem.addEventListener('click', function (event) {
                    // Check if the clicked menu item has a valid href attribute
                    const href = this.getAttribute('href');
                    if (href && href !== '#') {
                        // Remove the 'active' class from all menu items
                        menuItems.forEach(function (item) {
                            item.parentElement.classList.remove('active');
                        });

                        // Add the 'active' class to the parent li element of the clicked menu item
                        this.closest('li').classList.add('active');
                    } else {
                        event.preventDefault(); // Prevent the default link behavior for invalid href values
                    }
                });
            });
        });
    </script>


    <nav>
        <ul>
            <li><a class="active" href="Awelcome.php" target="content">Menu Utama</a></li>
            <!-- <li><a href="Aproduk.php" target="content">Senarai Produk</a></li> -->
            <li><a href="#">Utiliti Produk</a>
                <ul>
                    <li><a href="AutilitiProduk.php" target="content">Kemaskini/Padam</a></li>
                    <li><a href="Atambah.php" target="content">Tambah</a></li>
                </ul>
            </li>
            <li><a href="Aimport.php" target="content">Import</a></li>
            <li><a href="Alaporan.php" target="content">Laporan</a></li>
            <li><a href="Aakaun.php" target="content">Akaun</a></li>
            <li><a href="logout.php">Log Keluar</a></li>
        </ul>
    </nav>
    <div id="content"></div>
</body>

</html>
<?php
mysqli_close($conn);
?>