<?php
    session_start();
    //cek session
    if (!isset($_SESSION["login"])){
        
        header("Location: login.php");
        exit;
    }

    if ($_SESSION["info_user"] != "admin"){
        echo "<script>alert('Anda bukan Master Admin.')</script>";
        header("Location: dashboard.php");
    }

    require 'assets/includes/dbconfig.php';

    function registrasi($data){
        global $db;
        $username = strtolower(stripslashes($data["username"]));
        $password = mysqli_real_escape_string($db,$data["password"]);
        $password2 = mysqli_real_escape_string($db,$data["password2"]);
    
        //cek availability username
        $result = mysqli_query($db, "SELECT log_username FROM tb_login WHERE log_username = '$username'");
    
        if( mysqli_fetch_assoc($result) ){
            echo "<script>alert('username sudah ada')</script>";
            return false;
        }
    
        //cek konfirmasi password
        if( $password !== $password2 ) {
            echo "<script> alert('konfirmasi salah');</script>";
            return false;
        }
    
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        //tambah user ke db
        mysqli_query($db, "insert into tb_login values('', '$username','$password')");
    
        return mysqli_affected_rows($db);
    
    }
    
    if( isset($_POST["register"])){
        if(registrasi($_POST)>0){
            echo "<script>alert('Berhasil Ditambahkan');</script>";
        }else{
            echo mysqli_error($db);
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilitas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/list_buku.css">
    <link rel="stylesheet" href="assets/css/pengunjung.css">

<body>

    <div class="container-main container-fluid">
        <div class="sidemenu">
            
            <div class="sidemenu-top">
                <h3 class="text-title">Dashboard<br>Perpustakaan</h3>
                <p class="text-subtitle">
                <?php
                    if(isset($_SESSION["info_user"])) {
                        $username = $_SESSION["info_user"];
                        echo "Welcome, $username";
                    }else {
                        // Handle the case where the session variable is not set
                        echo "Welcome, Guest!";
                    }
                ?>
                </p>
            </div>

            <div class="sidemenu-mid">
                <button type="button" class="btn btn-sidemenu btn-sidemenu-format" onclick="window.location.href='dashboard.php'">
                    <span class="material-symbols-outlined">
                        dashboard
                    </span>
                    &#12644 Dashboard
                </button>

                <button type="button" class="btn btn-sidemenu btn-sidemenu-format" onclick="window.location.href='list_buku.php'">
                    <span class="material-symbols-outlined">
                        menu_book
                    </span>
                    &#12644 List Buku
                </button>

                <button type="button" class="btn btn-sidemenu btn-sidemenu-format" onclick="window.location.href='member.php'">
                    <span class="material-symbols-outlined">
                        supervised_user_circle
                    </span>
                    &#12644 Member
                </button>

                <button type="button" class="btn btn-sidemenu btn-sidemenu-format" onclick="window.location.href='peminjaman.php'">
                    <span class="material-symbols-outlined">
                        sync_alt
                    </span>
                    &#12644 Peminjaman
                </button>
                <button type="button" class="btn btn-sidemenu-active btn-sidemenu-format" onclick="window.location.href='Utilitas.php'">
                    <span class="material-symbols-outlined">
                        settings
                    </span>
                    &#12644 Utilitas
                </button>
            </div>

            <div class="sidemenu-bottom">
            <button type="button" class="btn btn-sidemenu-bottom" onclick="window.location.href='logout.php'">
                <span class="material-symbols-outlined">
                    logout
                </span>
                Logout
            </button>
            </div>

        </div>
        
        <div class="contents">
            <div class="contents-mid">
                
                <h1><b>Registrasi</b></h1>
                <hr>
                
                <form action="" method="post">
                    <ul>
                        <li>
                            Masukkan username :<br>
                            <input type="text" placeholder="Username" name="username" id="username" class="input-group-text" style="width:30%;" >
                        </li>
                        <li>
                            Masukkan password :<br>
                            <input type="password" placeholder="Password" name="password" id="password" class="input-group-text" style="width:30%;" >
                        </li>
                        <li>
                            Konfirmasi password :<br>
                            <input type="password" placeholder="Konfirmasi password" name="password2" id="password2" class="input-group-text" style="width:30%;" >
                        </li>
                        <button class="btn btn-dark" type="submit" name="register">Register</button>
                    </ul>
                </form>

            </div>
                
        </div>
    </div>
<sekrip>
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
        
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
        
        <script src="./assets/js/app.js"></script>            
</sekrip>

</body>
</html>