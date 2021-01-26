<?php
session_start();
require 'functions.php';
// cek cookie
if(isset($_COOKIE['id']) && isset($_COOKIE['key'])){
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];
    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE
    id = '$id'");
    $row = mysqli_fetch_assoc($result);
    //cek cookie dan username
    if ($key === hash('sha256', $row['username'])){
        $_SESSION['login'] = true;
    }
}
if(isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}
if (isset($_POST['login'])){   
    $usename = $_POST['username'];
    $password = $_POST['password'];
    $result = mysqli_query($conn, "SELECT * FROM user WHERE username = '$usename'");
    if(mysqli_num_rows($result) === 1){
        // cek password
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row["password"])){
            // set session
            $_SESSION["login"] = true;
            // cek remember me
            if(isset($_POST['remember'])){
                // buat cookie
                setcookie('id', $row['id'], time()+60);
                setcookie('key', hash('sha256', $row['username']), time()+60);
            }
            header("Location: index.php");
            exit;
        }
    }
    $error = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Login</title>
</head>
<body class="bg-light">
    <header>
        <div class="container text-center m-5">
            <h1>Login</h1>
        </div>
    </header>

    <main>
        <section>
            <div class="card position-absolute top-50 start-50 translate-middle">
            <?php if(isset($error)) : ?>
                <div class="container pt-2">
                    <div class="alert alert-danger" role="alert">Username/Password salah</div>
                </div>
            <?php endif; ?>
                <div class="card-body">
                    <div class="container">
                        <form method="post" action="">    
                            <div class="mb-3">
                                <label for="username" class="form-label">Username: </label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password: </label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-3 form-check">
                                <input type="checkbox" name="remember" id="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Remember Me</label>
                            </div>
                            <a href="https://api.whatsapp.com/send/?phone=%2B6285156405286&text&app_absent=0" class="btn btn-warning text-white">Daftar Akun</a>
                            <button type="submit" name="login" class="btn btn-primary">Login</button>
                        </form>
                    </div>  
                </div>
            </div>
        </section>
    </main>
</body>
</html>