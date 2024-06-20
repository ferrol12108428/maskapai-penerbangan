<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Pajak Bandara</title>
  <!-- Menghubungkan stylesheet external untuk gaya tampilan -->
  <link rel="stylesheet" href="assets/css/style.css" />
  <!-- Menghubungkan FontAwesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <!-- Navigasi utama -->
    <nav>
      <ul>
        <!-- Logo dan nama perusahaan -->
        <li><a href="" class="logo">
            <img src="assets/img/logo.png">
            <span class="nav-item">AirTravel</span>
          </a></li>
        <!-- Tautan menu Dashboard -->
        <li>
          <a href="index.php">
            <i class="fas fa-home"></i>
            <span class="nav-item">Dashboard</span>
          </a>
        </li>
        <!-- Tautan menu Formulir -->
        <li><a href="form.php">
            <i class="fas fa-pen"></i>
            <span class="nav-item">Formulir</span>
          </a></li>
      </ul>
    </nav>

    <!-- Bagian utama konten halaman -->
    <section class="main">
      <div class="main-top">
        <!-- Judul halaman -->
        <h1>Informasi Pajak Bandara</h1>
      </div>

      <!-- Bagian daftar bandara asal -->
      <section class="bandara">
        <div class="bandara-list">
          <h1>Bandara Asal</h1>
          <!-- Tabel untuk menampilkan daftar bandara asal -->
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Bandara Asal</th>
                <th>Pajak</th>
              </tr>
            </thead>
            <tbody>
              <!-- Baris data bandara asal -->
              <?php
              // File Json yang akan dibaca
              $file = 'data/bandara_asal.json';
              $getFile = file_get_contents($file);
              $datas = json_decode($getFile, true);
              $i = 1;

              foreach ($datas as $data) {
                if ($i % 2 === 0) {
                  echo '<tr class="active">';
                  echo '<td>' . $i++ . '</td>';
                  echo '<td>' . $data['bandara_asal'] . "</td>";
                  echo '<td>' . $data['pajak'] . "</td>";
                  echo '</tr>';
                } else {
                  echo '<tr>';
                  echo '<td>' . $i++ . '</td>';
                  echo '<td>' . $data['bandara_asal'] . "</td>";
                  echo '<td>' . $data['pajak'] . "</td>";
                  echo '</tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
      </section>

      <!-- Bagian daftar bandara tujuan -->
      <section class="bandara">
        <div class="bandara-list">
          <h1>Bandara Tujuan</h1>
          <!-- Tabel untuk menampilkan daftar bandara tujuan -->
          <table class="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Bandara Tujuan</th>
                <th>Pajak</th>
              </tr>
            </thead>
            <tbody>
              <!-- Baris data bandara tujuan -->
               <?php
                // File Json yang akan dibaca
                $file = 'data/bandara_tujuan.json';
                $getFile = file_get_contents($file);
                $datas = json_decode($getFile, true);
                $i = 1;

                foreach ($datas as $data) {
                  if ($i % 2 === 0) {
                    echo '<tr class="active">';
                    echo '<td>' . $i++ . '</td>';
                    echo '<td>' . $data['bandara_tujuan'] . "</td>";
                    echo '<td>' . $data['pajak'] . "</td>";
                    echo '</tr>';
                  } else {
                    echo '<tr>';
                    echo '<td>' . $i++ . '</td>';
                    echo '<td>' . $data['bandara_tujuan'] . "</td>";
                    echo '<td>' . $data['pajak'] . "</td>";
                    echo '</tr>';
                  }
                }
               ?>
            </tbody>
          </table>
        </div>
      </section>
    </section>
  </div>
</body>

</html>