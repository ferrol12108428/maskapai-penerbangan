<!DOCTYPE html>
<html lang="id">

<head>
    <!-- Title Browser Start-->
    <title>Rute Penerbangan</title>
    <!-- Title Browser End-->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

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
        <a href="index.php" class="btn btn-danger mt-5">Back</a>
        <div class="card mt-2">
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
                    <div class="form-group">
                        <label for="inputState">Bandara Asal :</label>
                        <select id="inputState" class="form-control" name="bandara_asal">
                            <option selected disabled hidden>Choose...</option>

                            <?php
                            // File Json yang akan dibaca
                            $file = 'data/bandara_asal.json';

                            // Mengambil file Json
                            $getFile = file_get_contents($file);

                            // Mendecode Json atau mengubah json menjadi Array
                            $datas = json_decode($getFile, true);

                            // Membaca data dari Array menggunakan perulangan foreach
                            foreach ($datas as $data) {
                                // Melakukan pengecekan jika data dari 'bandara_asal' ada, maka akan ditampilkan nama 'bandara_asal' tersebut
                                if (isset($data['bandara_asal'])) {
                                    echo '<option>' . $data['bandara_asal'] . '</option>';
                                } else {
                                    echo 'Tidak Ada';
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <!-- Input Bandara Tujuan -->
                    <div class="form-group">
                        <label for="inputState">Bandara Tujuan :</label>
                        <select id="inputState" class="form-control" name="bandara_tujuan">
                            <option selected hidden disabled>Choose...</option>

                            <?php
                            // File Json yang akan dibaca
                            $file = 'data/bandara_tujuan.json';

                            // Mengambil file Json
                            $getFile = file_get_contents($file);

                            // Mendecode Json atau mengubah json menjadi Array
                            $datas = json_decode($getFile, true);

                            // Membaca data dari Array menggunakan perulangan foreach
                            foreach ($datas as $data) {
                                // Melakukan pengecekan jika data dari 'bandara_tujuan' ada, maka akan ditampilkan nama 'bandara_tujuan' tersebut
                                if (isset($data['bandara_tujuan'])) {
                                    echo '<option>' . $data['bandara_tujuan'] . '</option>';
                                } else {
                                    echo 'Tidak Ada';
                                }
                            }
                            ?>

                        </select>
                    </div>

                    <!-- Input Harga Tiker -->
                    <div class="form-group">
                        <label for="harga">Harga Tiket :</label>
                        <input type="number" class="form-control" id="umur" name="harga" required>
                    </div>

                    <!-- Button untuk mengirim data -->
                    <button type="submit" class="btn btn-primary" name="submit">SUBMIT</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Memeriksa apakah form telah dikirim atau tidak melalui tombol 'Submit'.
    if (isset($_POST['submit'])) {
        $maskapai = $_POST['maskapai'];
        $bandara_asal = $_POST['bandara_asal'];
        $bandara_tujuan = $_POST['bandara_tujuan'];
        $harga = (int) $_POST['harga'];

        // Membaca, mengambil, dan mengubah file Json menjadi Array
        $bandaraAsalData = json_decode(file_get_contents('data/bandara_asal.json'), true);
        $bandaraTujuanData = json_decode(file_get_contents('data/bandara_tujuan.json'), true);

        // Melakukan inisialisasi sebagai nilai awal
        $pajakAsal = 0;
        $pajakTujuan = 0;

        // Membaca data dari Array menggunakan perulangan foreach
        foreach ($bandaraAsalData as $data) {
            // Memeriksa apabila data dari 'bandara_asal' sesuai dengan nilai input yang dikirim maka akan ditambahkan pajak
            if ($data['bandara_asal'] === $bandara_asal) {
                $pajakAsal = $data['pajak'];
                // Menghentikan perulangan jika sesuai dengan kondisi
                break;
            }
        }

        // Membaca data dari Array menggunakan perulangan foreach
        foreach ($bandaraTujuanData as $data) {
            // Memeriksa apabila data dari 'bandara_tujuan' sesuai dengan nilai input yang dikirim maka akan ditambahkan pajak
            if ($data['bandara_tujuan'] === $bandara_tujuan) {
                $pajakTujuan = $data['pajak'];
                // Menghentikan perulangan jika sesuai dengan kondisi
                break;
            }
        }

        $total_pajak = $pajakAsal + $pajakTujuan;

        $total_harga_tiket = $total_pajak + $harga;


        // Membaca, mengambil, dan mengubah file Json menjadi Array
        $file = 'data/data.json';
        $jsonfile = file_get_contents($file);
        $dataJson = json_decode($jsonfile, true);

        // Data-data yang akan disimpan dalam Json
        $dataJson[] = array(
            'maskapai' => $maskapai,
            'bandara_asal' => $bandara_asal,
            'bandara_tujuan' => $bandara_tujuan,
            'harga' => $harga,
            'pajak_asal' => $pajakAsal,
            'pajak_tujuan' => $pajakTujuan,
            'total_pajak' => $total_pajak,
            'total_harga_tiket' => $total_harga_tiket
        );

        // Mengencode dari Array menjadi Json
        $jsonpost = json_encode($dataJson, JSON_PRETTY_PRINT);

        // Menyimpan data ke dalam data Json
        file_put_contents('data/data.json', $jsonpost);

        // Mengarahkan kembali ke Form dan menghentikan eksekusi program
        header('Location: form.php');
        exit;
    }
    ?>

    <div class="container mt-5">
        <h1>Daftar Rute Tersedia</h1>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Maskapai</th>
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
                $jsonfile = 'data/data.json';
                $getFile = file_get_contents($jsonfile);
                $datas = json_decode($getFile, true);
                $i = 1;

                // mengecek data dari vairable $datas
                if (!empty($datas)) {
                    // jika data tidak kosong maka, akan menampikan foreach
                    foreach ($datas as $data) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . $data['maskapai'] . "</td>";
                        echo '<td>' . $data['bandara_asal'] . "</td>";
                        echo '<td>' . $data['bandara_tujuan'] . "</td>";
                        echo '<td>Rp. ' . number_format($data['harga'], 0, ',', '.') . "</td>";
                        echo '<td>Rp. ' . number_format($data['total_pajak'], 0, ',', '.')  . "</td>";
                        echo '<td>Rp. ' . number_format($data['total_harga_tiket'], 0, ',', '.') . "</td>";
                        echo '</tr>';
                    }
                } else {
                    // jika data kosong, maka else yang akan di tampilkan
                    echo '<tr><td colspan="7" class="text-center" style="font-weight:bold;">Tidak ada data</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>