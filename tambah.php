<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';
if(isset($_POST["submit"])){
    if(tambah($_POST) > 0){
        echo "
            <script>
                alert('Data berhasil ditambahkan :)');
                document.location.href = 'index.php';
            </script>
            ";
    } else {
        echo "
            <script>
                alert('Maaf, Data gagal ditambahkan :(');
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
    <title>Tambah data</title>
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
            <h1>Tambah Data</h1>
        </div>
    </header>

    <main>
        <section>
            <div class="container">
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama: </label>
                        <input type="text" name="nama" id="nama" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-Mail: </label>
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="moto" class="form-label">Moto Hidup: </label>
                        <input type="text" name="moto" id="moto" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Foto: </label>
                        <input type="file" name="gambar" id="gambar" class="form-control">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="submit">Tambah</button>
                        <a href="index.php" class="btn btn-secondary">Kembali</a>
                    </div>
                </form>
            </div>
        </section>
    </main>
</body>
</html>