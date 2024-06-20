<!DOCTYPE html>
<html lang="id">

<head>
  <title>Rute Penerbangan</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <div class="container">
    <h1 class="mt-5">Pendaftaran Rute Penerbangan</h1>
    <form method="POST" action="action.php">
      <div class="form-group">
        <label for="nama">Maskapai:</label>
        <input type="text" class="form-control" id="maskapai" name="maskapai" required>
      </div>
      <div class="form-group ">
      <label for="inputState">Bandara Asal:</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
    <div class="form-group ">
      <label for="inputState">Bandara Tujuan:</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
      </select>
    </div>
      <div class="form-group">
        <label for="umur">Harga Tiket:</label>
        <input type="number" class="form-control" id="umur" name="umur" required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
    </form>
  </div>
</body>

<?php
//   if (isset($_POST['submit'])) {
//     $nama = $_POST['nama'];
//     $nomor = $_POST['nomor'];
//     $umur = $_POST['umur'];


    echo '<!DOCTYPE html>';
    echo '<html lang="id">';
    echo '<head>';
    echo '<title>Data Diri</title>';
    echo '<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">';
    echo '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>';
    echo '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>';
    echo '</head>';
    echo '<body>';
    echo '<div class="container mt-5">';
    echo '<h1>Data Diri</h1>';
    echo '<table class="table table-bordered">';
    echo '<thead class="thead-dark">';
    echo '<tr>';
    echo '<th>Nama</th>';
    echo '<th>No. WhatsApp</th>';
    echo '<th>Umur</th>';
    echo '</tr>';
    echo '</thead>';
    echo '</table>';
    echo '</div>';
    echo '</body>';
    echo '</html>';
?>


</html>
