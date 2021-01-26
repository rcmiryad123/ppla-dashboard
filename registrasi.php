<?php
require 'functions.php';
if (isset($_POST["register"])){
    if (registrasi($_POST) > 0){
        echo "
            <script>
                alert('User baru telah ditambahkan');
                document.location.href = 'index.php';
            </script>
        ";
    }else {
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Registrasi</title>
</head>
<body>
    <header>
        <div class="container text-center m-5">
            <h1>Register</h1>
        </div>
    </header>

    <main>
        <section>
            <div class="card position-absolute top-50 start-50 translate-middle">
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
                            <div class="mb-3">
                                <label for="password2">Konfirmasi Password</label>
                                <input type="password" name="password2" id="password2" class="form-control">
                            </div>
                            <button type="submit" name="register" class="btn btn-primary">Daftar</button>
                        </form>
                    </div>  
                </div>
            </div>
        </section>
    </main>
</body>
</html>