<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Title Browser Start-->
    <title>Rute Penerbangan</title>
    <!-- Title Browser End-->

    <!-- Link Google Fonts Start -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Link Google Fonts End -->

  <!-- Link Bootstrap Start -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Link Bootstrap End -->
</head>

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

<body>
    <div class="container">
        <div class="card mt-4">
            <div class="card-header bg-dark">
                <h1 class="m-2 text-white text-center">Pendaftaran Rute Penerbangan</h1>
            </div>

            <div class="card-body">
                <!-- Form berfungsi untuk mengirim data dari input -->
                <form method="POST" action="form.php">

                    <!-- Input Maskapai -->
                    <div class="form-group">
                        <label for="nama">Maskapai:</label>
                        <input type="text" class="form-control" id="maskapai" name="maskapai" required>
                    </div>

                    <!-- Input Bandara Asal -->
                    <div class="form-group ">
                        <label for="inputState">Bandara Asal:</label>
                        <select id="inputState" class="form-control" name="bandaraAsal">
                            <option selected disabled>Choose...</option>

                            <?php
                            // File Json yang akan dibaca
                            $file = 'data/bandaraAsal.json';
                            
                            // Mengambil file Json
                            $getFile = file_get_contents($file);
                            
                            // Mendecode Json atau mengubah json menjadi Array
                            $datas = json_decode($getFile, true);
                            
                            // Membaca data dari Array menggunakan perulangan foreach
                            foreach ($datas as $data) {
                                // Melakukan pengecekan jika data dari 'bandaraAsal' ada, maka akan ditampilkan nama 'bandaraAsal' tersebut
                                if (isset($data['bandaraAsal'])) {
                                    echo '<option>' . $data['bandaraAsal'] . '</option>';
                                } else {
                                    echo 'Tidak Ada';
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <!-- Input Bandara Tujuan -->
                    <div class="form-group ">
                        <label for="inputState">Bandara Tujuan:</label>
                        <select id="inputState" class="form-control" name="bandaraTujuan">
                            <option selected>Choose...</option>

                            <?php
                            // File Json yang akan dibaca
                            $file = 'data/bandaraTujuan.json';
                            
                            // Mengambil file Json
                            $getFile = file_get_contents($file);
                            
                            // Mendecode Json atau mengubah json menjadi Array
                            $datas = json_decode($getFile, true);
                            
                            // Membaca data dari Array menggunakan perulangan foreach
                            foreach ($datas as $data) {
                                // Melakukan pengecekan jika data dari 'bandaraTujuan' ada, maka akan ditampilkan nama 'bandaraTujuan' tersebut
                                if (isset($data['bandaraTujuan'])) {
                                    echo '<option>' . $data['bandaraTujuan'] . '</option>';
                                } else {
                                    echo 'Tidak Ada';
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <!-- Input Harga Tiket -->
                    <div class="form-group">
                        <label for="harga">Harga Tiket:</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>

                    <!-- Button untuk mengirim data -->
                    <button type="submit" class="btn btn-secondary" name="submit">Submit</button>
                    <a href="index.php" class="btn btn-secondary float-right">Back</a>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Memeriksa apakah form telah dikirim atau tidak melalui tombol 'Submit'.
    if (isset($_POST['submit'])) {
        $maskapai = $_POST['maskapai'];
        $bandaraAsal = $_POST['bandaraAsal'];
        $bandaraTujuan = $_POST['bandaraTujuan'];
        $harga = (int) $_POST['harga'];
    
        // Membaca, mengambil, dan mengubah file Json menjadi Array
        $bandaraAsalData = json_decode(file_get_contents('data/bandaraAsal.json'), true);
        $bandaraTujuanData = json_decode(file_get_contents('data/bandaraTujuan.json'), true);
    
        // Melakukan inisialisasi sebagai nilai awal
        $pajakAsal = 0;
        $pajakTujuan = 0;
    
        // Membaca data dari Array menggunakan perulangan foreach
        foreach ($bandaraAsalData as $data) {
            // Memeriksa apabila data dari 'bandaraAsal' sesuai dengan nilai input yang dikirim maka akan ditambahkan pajak
            if ($data['bandaraAsal'] === $bandaraAsal) {
                $pajakAsal = $data['pajak'];
                // Menghentikan perulangan jika sesuai dengan kondisi
                break;
            }
        }
    
        // Membaca data dari Array menggunakan perulangan foreach
        foreach ($bandaraTujuanData as $data) {
            // Memeriksa apabila data dari 'bandaraTujuan' sesuai dengan nilai input yang dikirim maka akan ditambahkan pajak
            if ($data['bandaraTujuan'] === $bandaraTujuan) {
                $pajakTujuan = $data['pajak'];
                // Menghentikan perulangan jika sesuai dengan kondisi
                break;
            }
        }
    
        // Menghitung total pajak
        function totalPajak($pajakAsal, $pajakTujuan)
        {
            return $pajakAsal + $pajakTujuan;
        }
    
        // Menghitung total harga tiket
        function totalHargaTiket($totalPajak, $harga)
        {
            return $totalPajak + $harga;
        }
    
        // Memanggil function yang sudah dibuat
        $totalPajak = totalPajak($pajakAsal, $pajakTujuan);
        $totalHargaTiket = totalHargaTiket($totalPajak, $harga);
    
        // Membaca, mengambil, dan mengubah file Json menjadi Array
        $file = 'data/data.json';
        $jsonfile = file_get_contents($file);
        $dataJson = json_decode($jsonfile, true);
    
        // Data-data yang akan disimpan dalam Json
        $dataJson[] = [
            'maskapai' => $maskapai,
            'bandaraAsal' => $bandaraAsal,
            'bandaraTujuan' => $bandaraTujuan,
            'harga' => $harga,
            'pajakAsal' => $pajakAsal,
            'pajakTujuan' => $pajakTujuan,
            'totalPajak' => $totalPajak,
            'totalHargaTiket' => $totalHargaTiket,
        ];
    
        // Mengencode dari Array menjadi Json
        $jsonPost = json_encode($dataJson, JSON_PRETTY_PRINT);
    
        // Menyimpan data ke dalam data Json
        file_put_contents('data/data.json', $jsonPost);
    
        // Mengarahkan kembali ke Form dan menghentikan eksekusi program
        header('Location: form.php');
        exit();
    }
    ?>

    <div class="container mt-5">
        <h1 class="text-center m-2">Daftar Rute Tersedia</h1>
        <table class="table table-bordered" style="border-radius: 20px;">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Asal Penerbangan</th>
                    <th>Tujuan Penerbangan</th>
                    <th>Harga Tiket</th>
                    <th>Pajak</th>
                    <th>Total Harga Tiket</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Membaca, mengambil, dan mengubah file Json menjadi Array
                $jsonFile = 'data/data.json';
                $getFile = file_get_contents($jsonFile);
                $datas = json_decode($getFile, true);
                $i = 1;
                
                // Melakukan pengecekan jika data dari data.json tidak kosong maka eksekusi program akan dilakukan
                if (!empty($datas)) {
                    // Mengekstrak kolom 'maskapai' dari data.json
                    $maskapaiColumn = array_column($datas, 'maskapai');
                
                    // Mengurutkan data berdasarkan kolom 'maskapai'
                    array_multisort($maskapaiColumn, SORT_ASC, $datas);
                }
                
                // Melakukan pengecekan jika data dari data.json tidak kosong maka eksekusi program akan dilakukan
                if (!empty($datas)) {
                    // Membaca data dari Array menggunakan perulangan foreach
                    foreach ($datas as $data) {
                        // Menampilkan output tabel
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . $data['maskapai'] . '</td>';
                        echo '<td>' . $data['bandaraAsal'] . '</td>';
                        echo '<td>' . $data['bandaraTujuan'] . '</td>';
                        echo '<td>Rp. ' . number_format($data['harga'], 0, ',', '.') . '</td>';
                        echo '<td>Rp.' . number_format($data['totalPajak'], 0, ',', '.') . '</td>';
                        echo '<td>Rp.' . number_format($data['totalHargaTiket'], 0, ',', '.') . '</td>';
                        echo '</tr>';
                    }
                } else {
                    // Jika tidak ada data pada data.json maka akan menampilkan 'Tidak ada data'
                    echo '<tr><td colspan="7" class="text-center" style="font-weight:bold;">Tidak ada data</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
