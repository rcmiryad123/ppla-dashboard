<?php

$m_host = 'localhost';
$m_user = 'root';
$m_pass = '';
$m_db = 'php_dasar';

// connect to db
$conn = mysqli_connect($m_host, $m_user, $m_pass, $m_db);


function query($query){

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}

function tambah($data){
    
    global $conn;
    // htmlspecialchars
    $moto = htmlspecialchars($data["moto"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    
    // upload gambar
    $gambar = upload();
    if(!$gambar){{
        return false;
    }};

    $query = "INSERT INTO mahasiswa (nama, moto, email, gambar) 
              VALUES ('$nama', '$moto', '$email', '$gambar')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function upload(){
    
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    // cek apakah tidak ada gambar yang di upload
    if ($error === 4){
        echo "
            <script>
                alert('Pilih gambar dulu');
            </script>
        ";
        return false;
    };

    // cek gambar atau bukan
    $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if (!in_array($ekstensiGambar, $ekstensiGambarValid)){
        echo "
            <script>
                alert('yang diupload bukan gambar');
            </script>
        ";
        return false;
    };

    // cek jika ukuran gambar terlalu besar
    if($ukuranFile > 1000000){
        echo "
            <script>
                alert('Ukuran gambar terlalu besar');
            </script>
        ";
        return false;
    };

    // lolos pengecekan siap upload
    // generate nama baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;

}

function hapus($id) {
    global $conn;

    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
    return mysqli_affected_rows($conn);
}

function ubah($data) {
    global $conn;

    $id = $data["id"];
    $moto = htmlspecialchars($data["moto"]);
    $nama = htmlspecialchars($data["nama"]);
    $email = htmlspecialchars($data["email"]);
    $gambarLama = $data["gambarLama"];

    //cek apakah user pilih gambar baru atau tidak
    if ($_FILES["gambar"]["error"] === 4){
        $gambar = $gambarLama;
    }else {
        $gambar = upload();
    }

    $query = "UPDATE mahasiswa SET
                moto = '$moto', 
                nama = '$nama',
                email = '$email', 
                gambar = '$gambar'
              WHERE id = $id
             ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function cari($keyword) {
    $query = "SELECT * FROM mahasiswa 
              WHERE nama LIKE '%$keyword%' OR
              moto LIKE '%$keyword%' OR
              email LIKE '%$keyword%'";

    return query($query);
} 

function registrasi($data){
    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);


    // cek username udah ada atau belum
    $result = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
    if (mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username yang dipilih sudah digunakan')
            </script>";
            return false;
    }

    //cek konfirmasi password
    if($password !== $password2){
        echo "
        <script>
            alert('Password tidak sesuai');
        </script>
        ";
        return false;
    }

    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // tambah user baru ke database
    mysqli_query($conn, "INSERT INTO user (username, password) VALUES ('$username', '$password')");
    return mysqli_affected_rows($conn);
}

?>