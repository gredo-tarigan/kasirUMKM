<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Login - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Quicksand">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
</head>

<body class="d-flex align-items-center bg-gradient-primary">
    <div class="container d-flex justify-content-center">

        <div class="card shadow-lg d-flex float-start d-xxl-flex o-hidden border-0 my-5">
            @if (session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            @endif
            <div class="text-center justify-content-center p-5">
                <div class="text-center" style="padding-bottom: 10px; padding-top: 10px;"><i class="fa fa-user-circle"
                        style="font-size: 70px"></i></div>
                <div class="text-center">
                    <h5 class="text-dark mb-4">Silahkan Login!</h5>
                </div>
                <form action="/" method="POST">
                    @csrf
                    <div class="mb-3"><input class="form-control form-control-user" type="text" id="username"
                            aria-describedby="emailHelp" placeholder="Masukkan Username" name="username" autofocus
                            required></div>
                    <div class="mb-3"><input class="form-control form-control-user" type="password"
                            id="password" placeholder="Masukkan Password" name="password" required></div>
                    <div class="mb-3">
                        <div class="custom-control custom-checkbox small"></div>
                    </div><button class="btn btn-primary border rounded-pill d-block btn-user w-100"
                        type="submit">Login</button>
                  
                </form>
                <button class="btn btn-success border rounded-pill d-block w-100 text-white"
                id="buttonWelcome" data-toggle="modal" data-target="#modalWelcome">Help</button>
                <hr>
                <div class="text-center">
                    <marquee direction="left">Welcome to : OLALA CASHIER!</marquee>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalWelcome" tabindex="-1" aria-labelledby="staticBackdropLabel3" aria-hidden="">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header card-header py-3">
                    <p class="text-primary m-0 fw-bold">Welcome!</p>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <text>Selamat datang di project aplikasi web kasir dan manajemen data toko retail!
                        </br></br>Project ini dibangun dengan subject toko snack bernama OLALA di Semarang. Dibangun untuk
                        memenuhi
                        kebutuhan kasir untuk melayani
                        penjualan berdasarkan kuantitas barang dan massa barang (snack belinya per beratnya dengan harga
                        tertentu), dan juga pencatatan keperluan data
                        toko seperti data barang, stok, penjualan, dan pengeluaran.</br></br>
                        Contoh barang penjualan berdasarkan massa : Bakso Goreng
                        Contoh barang penjualan berdasarkan kuantitas : Floridina
                        </br></br>
                        Untuk menggunakan sistem:</br>
                        Akun owner (superuser/admin)</br> username / password = </br><center> owner / owner </center></br>
                        Akun kasir</br> username / password = </br><center> kasir / kasir </center></br>
                    </text>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
    <script type="text/javascript">
        $('#buttonWelcome').on('click', function() {
            $('#modalWelcome').modal('show');
        });
    </script>
</body>

</html>
