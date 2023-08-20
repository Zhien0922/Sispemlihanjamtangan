<?php
require 'session.php';
require 'dbcon.php';
if(isset($_POST["upload"])) {
  if(isset($_FILES['datajenama']) && !empty($_FILES['datajenama']['name'])) {
    $ext = pathinfo($_FILES['datajenama']['name'], PATHINFO_EXTENSION);
    if($ext == 'csv'){
      $handle = fopen($_FILES["datajenama"]["tmp_name"],"r");
      $data = array();
      while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
          // for example, you can insert the data into a database
          $idjenama = mysqli_real_escape_string($conn,$row[0]) ;
          $jenama = mysqli_real_escape_string($conn,$row[1]) ;
          $import = "INSERT INTO jenama (IDjenama,Jenama) VALUES ('$idjenama','$jenama')";
          if(mysqli_query($conn,$import)){
            $success = true;
          }else{
            $success = false;
            break;
          }
      }
      fclose($handle);
      if ($success) {
        echo "<script> alert('Fail tersebut sudah berjaya diimport!'); </script>";
      } else {
        echo "<script> alert('Tidak berjaya import fail tersebut!'); </script>";
      }
    } else {
      echo "<script> alert('Salah jenis fail!'); </script>";
    }
  } else {
    echo "<script> alert('Sila pilih satu fail CSV!'); </script>";
  }
}
$query = "SELECT * FROM jenama";
$result = mysqli_query($conn, $query);
?>

<html>
<head>
  <title>Sistem Pemilihan Jam Tangan</title>
  <link href="style.css" rel="stylesheet" type="text/css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
  <h2>Import Jenama</h2>
<div class="all-form">
  <div class="form-container">
      <form class="form" method="post" enctype="multipart/form-data">
      <div class="input-group">
      <label for="file">Sila import fail csv:</label>
        <input type="file" required name="datajenama">
        <button class="sign" type="submit" name="upload">Muat naik</button>
</div>
    </form>
    </div>
  </div>
  <div class="tablesection">
    <table>
      <thead>
        <tr>
          <th>ID Jenama</th>
          <th>Jenama</th>
          <th colspan="2" align="center">Tindakan</th>
        </tr>
      </thead>
      <tbody>
        <?php
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" . $row['IDjenama'] . "</td>";
				echo "<td>" . $row['Jenama'] . "</td>";
		?>
        <form action="" method="post">
          <td>
            <a href="Akemaskini.php" target="content">
              <button type="submit" class="action" name="kemaskini">Kemaskini</button>
              <input type="hidden" name="idjenama" value="<?php echo $row['IDjenama']?>">
            </a>
          </td>
          <td>
            <button onclick="pasti()" type="submit" class="action" name="padam">Padam</button>
            <input type="hidden" name="idjenama" value="<?php echo $row['IDjenama']?>">
        </form>
        </td>
        </tr>
        <?php }?>
      </tbody>
    </table>
  </div>
  <?php
    if(isset($_POST['padam'])){
      $idjenama2 = $_POST['idjenama'];
      $sql = mysqli_query($conn,"SELECT * FROM jenama WHERE IDjenama = '$idjenama2'");

      if(mysqli_num_rows($sql) > 0){
          $delete = mysqli_query($conn,"DELETE FROM jenama WHERE IDjenama = '$idjenama2'");
          echo "<script> alert('Sudah dipadam!');
            window.location = 'Aimport.php'</script>";
      }else{
          echo "<script> alert('Error!');
            window.location = 'Aimport.php'</script>";
      }
      }
      if(isset($_POST['kemaskini'])){
          $idjenama2= $_POST['idjenama'];
          $sql = mysqli_query($conn, "SELECT * FROM jenama WHERE IDjenama = '$idjenama2'");

      if(mysqli_num_rows($sql) > 0){
          echo "<script> window.location = 'Akemaskini2.php'</script>";
      session_start();
      $row2 = mysqli_fetch_assoc($sql);

      if($row2['IDjenama'] === $idjenama2){
          $_SESSION['idjenama2'] = $row2['IDjenama'];
          $_SESSION['jenama2'] = $row2['Jenama'];
      }

  }
      }
  ?>
</body>

</html>
<?php
mysqli_close($conn);
?>