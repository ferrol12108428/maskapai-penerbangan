<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Maskapai Pnerbangan</title>
</head>

<body>
    <div class="container">
        <div class="card mt-5">
            <div class="card-header text-bg-dark">
                <h1 class="text-center">Jadwal Penerbangan Bandara X!</h1>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Maskapai</th>
                            <th scope="col">Pajak</th>
                        </tr>
                    </thead>
                    <tbody>
                        foreach ($resulet as $dt) {
                        echo $dt['id'] . "<br>";
                        echo $dt['maskapai'] . "<br>";
                        echo $dt['pajak'] . "<br>";
                        }
                        <tr>
                            <td>

                            </td>
                        </tr>
                        <?php

                        include "koneksi.php";

                        $sql = "SELECT * FROM user";
                        $resulet = mysqli_query($connection, $sql);

                        foreach ($resulet as $dt) {
                            echo $dt['id'] . "<br>";
                            echo $dt['maskapai'] . "<br>";
                            echo $dt['pajak'] . "<br>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>