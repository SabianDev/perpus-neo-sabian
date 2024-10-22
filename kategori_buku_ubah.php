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
    $ktgbuku = query("SELECT * FROM tb_buku_kategori WHERE ktg_id = $id")[0];

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
        $ktg_id = $data["ktg_id"];
        $ktg_nama = htmlspecialchars($data["ktg_nama"]);
    
        //query
        $query = "UPDATE tb_buku_kategori SET ktg_nama='$ktg_nama' WHERE ktg_id = $ktg_id";
    
        mysqli_query($db,$query);
    
        return mysqli_affected_rows($db);
    }

    if ( isset($_POST["submit"]) ) {
        
        if( ubah($_POST) > 0 ){
            echo "<script>
                    alert('Data berhasil diubah.');
                    document.location.href = 'kategori_buku.php';
                  </script>";
        }else{
            echo "<script>
                    alert('Error:" . htmlspecialchars(mysqli_error($db)) . "');
                    document.location.href = 'kategori_buku_ubah.php';
                  </script>";
        }
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori Buku - Ubah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/kategori_buku.css">
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
                <h3>Ubah Kategori Buku</h3><br>
                                
                <form action="" method="post">
                    <input type="hidden" name="ktg_id" value="<?= $ktgbuku["ktg_id"]; ?>">
                    <ul>
                        <li>
                            <span style="background-color:#253674; color:white; padding:5px;border-radius:10px;">
                                <b>ID Kategori : </b>
                                <?= $ktgbuku['ktg_id']; ?>
                            </span>
                            
                        </li>
                        
                        <li>
                            <b>Ubah Nama Kategori:</b>
                            <input type="text" class="input-group-text" name="ktg_nama" required value="<?= $ktgbuku["ktg_nama"];?>">
                        </li>
                        <li>
                            <button type="submit" class="btn btn-dark" name="submit">Ubah Data</button>
                            <button type="button" class="btn btn-dark" onclick="window.location.href='kategori_buku.php'">Kembali</button>
                        </li>
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