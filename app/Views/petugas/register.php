

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->


    <title>Perpus</title>
</head>

<body>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error'); ?>
    </div>
<?php endif; ?>

    <div class="container">
        <div class="row my-5">
            <div class="col-md-6 text-center login" style="background-image: url('/img/memphis-colorful.png');height: 600px;">
                <h4 class="fw-bold">Register | Petugas</h4>
                <!-- Ini Error jika tidak bisa login -->
                <form action="<?php echo base_url('/petugas/register'); ?>" method="post">
                    <div class="form-group user">
                        <input type="text" class="form-control w-50" placeholder="Masukkan Username" name="username" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="password" class="form-control w-50" placeholder="Masukkan Password" name="password" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="email" class="form-control w-50" placeholder="Masukkan Email" name="email" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="text" class="form-control w-50" placeholder="Masukkan Nama Lengkap" name="namalengkap" autocomplete="off" required>
                    </div>
                    <div class="form-group my-5">
                        <input type="text" class="form-control w-50" placeholder="Masukkan Alamat" name="alamat" autocomplete="off" required>
                    </div>
                    <button class="btn btn-primary text-uppercase" type="submit" name="register">Register</button>
                </form>
            </div>
        </div>
    </div>



    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
<style>
    body{
    font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    background-color: #00adb5;
    text-transform: uppercase;
}

.navbar-brand{
    font-family: 'Righteous', cursive;
}

.login {
    border: 0;
    height: 500px;
    margin: auto;
}

.login h4{
    margin-top: 40px;
}

form .form-group input{
    margin: auto;
}

form .user input{
    margin: auto;
    margin-top: 40px;
}
    </style>
</html>