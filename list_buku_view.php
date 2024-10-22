<?php
    session_start();
    //cek session
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    
    require 'assets/includes/dbconfig.php';


    //ambil data dari id di url
    $id = $_GET["id"];

    //query ambil data sesuai id
    $buku = query("SELECT * FROM tb_buku WHERE bk_id = $id")[0];

    function query($query){
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[]=$row;
        }
        return $rows;
    }
    function ubah($data) {
        global $db;
        $bk_id = $data["bk_id"];
        $bk_nama = htmlspecialchars($data["bk_nama"]);
        $bk_pengarang = htmlspecialchars($data["bk_pengarang"]);
        $bk_penerbit = htmlspecialchars($data["bk_penerbit"]);
        $bk_thnterbit = htmlspecialchars($data["bk_thnterbit"]);
        $bk_kategori = htmlspecialchars($data["bk_kategori"]);
        $bk_halaman = htmlspecialchars($data["bk_halaman"]);
    
        //query
        $query = "UPDATE tb_buku SET 
                bk_nama='$bk_nama',
                bk_pengarang='$bk_pengarang',
                bk_penerbit='$bk_penerbit',
                bk_thnterbit='$bk_thnterbit',
                bk_kategori='$bk_kategori',
                bk_halaman='$bk_halaman' 
                WHERE bk_id = $bk_id";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Buku - Detail Entri</title>

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

                <button type="button" class="btn btn-sidemenu-active btn-sidemenu-format" onclick="window.location.href='list_buku.php'">
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
                
                <div class="content-header">
                    <div class="header-title">
                        <h1 class="text-title">Detail Entri Buku</h1>
                    </div>
                    <div class="header-status">
                        <div class="status-style">
                            Status: <?= $buku["bk_status"];?>
                        </div>
                    </div>
                </div>
                <div class="container-tambah">
                    <table class="table table-details">
                        <tr>
                            <td style="width:180px;">ID Buku</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_id"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Judul</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_nama"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Pengarang</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_pengarang"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Penerbit</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_penerbit"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Tahun Terbit</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_thnterbit"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Kategori</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_kategori"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Jumlah Halaman</td>
                            <td style="width:30px;">:</td>
                            <td><?= $buku["bk_halaman"];?></td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-dark" onclick="window.location.href='list_buku.php'">Kembali</button>                        
                </div>
            </div>
        </div>
    </div>
</body>
</html>