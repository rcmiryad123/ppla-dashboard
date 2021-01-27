<?php
require '../functions.php';
$keyword = $_GET['keyword'];
$query =    "SELECT * FROM mahasiswa 
            WHERE nama LIKE '%$keyword%' OR
            moto LIKE '%$keyword%' OR
            email LIKE '%$keyword%'";
$mahasiswa = query($query);
?>
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
        <h5 class="text-center m-5 p-5">Sorry, Data Not Found</h5>
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
            <td><img src="img/<?= $mhs["gambar"]; ?>" width="50px"></td>
            <td><?= $mhs["nama"]; ?></td>
            <td><?= $mhs["moto"]; ?></td>
            <td><?= $mhs["email"]; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
