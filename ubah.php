<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';
$id = $_GET["id"];
$mhss = query("SELECT * FROM mahasiswa WHERE id = $id")[0];
if(isset($_POST["submit"])){
    if(ubah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil diubah :)');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Maaf, Data gagal diubah :(');
                document.location.href = 'tambah.php';
            </script>
            ";
    };
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Ubah data</title>
</head>
<body>
    <header>
        <nav class="navbar navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="tambah.php">Tambah Data</a>
                <a class="navbar-brand" href="logout.php">Logout</a>
            </div>
        </nav>
        <div class="container text-center m-5">
            <h1>Ubah Data</h1>
        </div>
    </header>
    <main>
        <section>
            <div class="container">
                <form method="post" action="" enctype="multipart/form-data">

                    <input type="hidden" name="gambarLama" value="<?= $mhss["gambar"]?>">
                    <input type="hidden" name="id" value="<?= $mhss["id"] ?>">

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama: </label>
                        <input type="text" name="nama" id="nama" class="form-control" value="<?= $mhss["nama"]?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail: </label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $mhss["email"]?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="moto" class="form-label">Moto Hidup: </label>
                        <input type="text" name="moto" id="moto" class="form-control" value="<?= $mhss["moto"]?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Foto: </label> <br>
                        <img src="img/<?= $mhss["gambar"]?>" alt="<?= $mhss["gambar"]?>" class="img-thumbnail rounded mb-2" width="80px">
                        <input type="file" name="gambar" id="gambar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Ubah</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>