<?php
    session_start();
    //cek session
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    
    require 'assets/includes/dbconfig.php';


    function tambahMbr($data) {
        global $db;
        $mbr_npm = htmlspecialchars($data["mbr_npm"]);
        $mbr_nama = htmlspecialchars($data["mbr_nama"]);
        $mbr_angkatan = htmlspecialchars($data["mbr_angkatan"]);
        
    
        //query
        $query = "INSERT INTO tb_member VALUES ('$mbr_npm','$mbr_nama','$mbr_angkatan')";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    //submit
    if ( isset($_POST["submit"]) ) {
        
        if( tambahMbr($_POST) > 0 ){
            echo "<script>
                    alert('Data berhasil ditambahkan.');
                    document.location.href = 'member.php';
                  </script>";
        }else{
            echo "<script>
                    alert('Error:" . htmlspecialchars(mysqli_error($db)) . "');
                    document.location.href = 'member_tambah.php';
                  </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member - Tambah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />


    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/list_buku.css">

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

                <button type="button" class="btn btn-sidemenu-active btn-sidemenu-format" onclick="window.location.href='member.php'">
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
                <button type="button" class="btn btn-sidemenu btn-sidemenu-format" onclick="window.location.href='Utilitas.php'">
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
            <div class="contents-tambah">
                <h1 class="text-title">Tambah Entri Member</h1>
                <div class="container-tambah">
                    <form action="" method="post">
                        <ul>
                            <li>
                                NPM<br>
                                <input type="text" class="input-group-text" name="mbr_npm" required>
                            </li>
                            <li>
                                Nama Lengkap<br>
                                <input type="text" class="input-group-text" name="mbr_nama" required>
                            </li>
                            <li>
                                Angkatan (Tahun)<br>
                                <input type="text" class="input-group-text" name="mbr_angkatan" required>
                            </li>
                            
                            <li>
                                <button type="submit" class="btn btn-dark" name="submit">Tambah Member</button>
                                <button type="button" class="btn btn-dark" onclick="window.location.href='member.php'">Kembali</button>
                            </li>
                        </ul>
                        
                    </form>
                </div>
            </div>
            
            
        
        </div>
    </div>
</body>
</html>