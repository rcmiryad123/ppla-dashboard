<?php
session_start();
if(!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa");
if(isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Selamat Datang</title>
    <style>.display{
        display: none;
        position: absolute;
    }</style>
</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <a class="btn btn-primary" href="tambah.php">Tambah Data</a>
                <a class="btn btn-danger" href="logout.php">Logout</a>
            </div>
        </nav>
        <img src="img/805.gif" class="display p-5">
        <div class="container text-center m-5">
            <h1>Selamat Datang, Admin</h1>
        </div>
    </header>

    <main>
        <div class="container alert"></div>
        <section>
            <div class="container">
                <div id="container" class="container bg-light pt-3 rounded">
                    <form method="post" action="">
                        <div class="input-group mb-3">
                            <input id="keyword" type="text" name="keyword" size="50" placeholder="Masukan Keyword Pencarian" autocomplete="off" class="form-control">
                            <!-- <button id="tombol-cari" type="submit" name="cari" class="btn btn-outline-secondary">Cari!</button> -->
                        </div>
                    </form>
                    <table class="table table-light">
                        <thead>
                            <tr class="table-dark">
                                <th scope="col">No. </th>
                                <th scope="col">Aksi. </th>
                                <th scope="col">Foto</th>
                                <th scope="col">Nama</th>
                                <th scope="col">E-Mail</th>
                                <th scope="col">Moto Hidup</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!$mahasiswa) : ?>
                            <h5>Sorry, Data Not Found</h5>
                            <?php else : ?>
                            <?php $i = 1 ?>
                            <?php foreach($mahasiswa as $mhs) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td>
                                    <div class="btn-group-sm btn-group">
                                        <a href="ubah.php?id=<?= $mhs["id"]; ?>" class="btn btn-success">ubah</a>
                                        <a href="hapus.php?id=<?= $mhs["id"]; ?>" onclick="return confirm('Yakin ingin dihapus?')" class="btn btn-danger">hapus</a>
                                    </div>
                                </td>
                                <td><img src="img/<?= $mhs["gambar"]; ?>" width="40px"></td>
                                <td><?= $mhs["nama"]; ?></td>
                                <td><?= $mhs["moto"]; ?></td>
                                <td><?= $mhs["email"]; ?></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <div class="container-fluid mt-5 text-center bg-dark p-3 text-white">
            <h5>Rizky Ferdi Nugraha</h5>
        </div>
    </footer>

<script src="js/jquery.js"></script>
<script src="js/script.js"></script>
</body>
</html>