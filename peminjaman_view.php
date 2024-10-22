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
    // $pjm = query("SELECT * FROM tb_peminjaman WHERE pjm_id = $id")[0];
    $pjm = query("SELECT pjm_id,tb_buku.bk_id,bk_nama,tb_peminjaman.mbr_npm,mbr_nama,pjm_tglpinjam,pjm_status,pjm_bataskembali,pjm_tglkembali,bk_pengarang,bk_penerbit FROM ((tb_peminjaman INNER JOIN tb_buku ON tb_peminjaman.bk_id = tb_buku.bk_id) INNER JOIN tb_member ON tb_peminjaman.mbr_npm = tb_member.mbr_npm) WHERE pjm_id = $id")[0];

    

    function query($query){
        global $db;
        $result = mysqli_query($db, $query);
        $rows = [];
        while($row = mysqli_fetch_assoc($result)){
            $rows[]=$row;
            
        }
        return $rows;
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman - Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />


    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/peminjaman.css">

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

                <button type="button" class="btn btn-sidemenu-active btn-sidemenu-format" onclick="window.location.href='peminjaman.php'">
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
                        <h1 class="text-title">Detail Transaksi</h1>
                    </div>
                    <div class="header-status">
                        <div class="status-denda">
                            ID Peminjaman : <?= $pjm["pjm_id"]; ?>
                        </div>
                        <div class="status-style">
                            Status Peminjaman: <?= $pjm["pjm_status"];?>
                        </div>
                        <div class="status-denda">
                            <?php
                            
                                $tglBatasRaw = $pjm['pjm_bataskembali'];
                                $tglBatas = date("d-m-Y", strtotime($tglBatasRaw)); 

                                $currentDate = date('Y-m-d');
                                if ($pjm['pjm_bataskembali'] < $currentDate){
                                    echo "Denda : Ya";
                                } else {
                                    echo "Denda : Tidak";
                                }
                            
                            ?>
                        </div>
                    </div>
                </div>
                <div class="container-tambah">
                    <table class="table table-details">
                        <tr>
                            <td style="width:180px;">NPM Peminjam</td>
                            <td style="width:30px;">:</td>
                            <td><?= $pjm["mbr_npm"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Nama Peminjam</td>
                            <td style="width:30px;">:</td>
                            <td><?= $pjm["mbr_nama"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">ID Buku</td>
                            <td style="width:30px;">:</td>
                            <td><?= $pjm["bk_id"];?></td>
                            <td>
                                <input type="hidden" id="bukuID" value="<?= $pjm["bk_id"];?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Judul Buku</td>
                            <td style="width:30px;">:</td>
                            <td><?= $pjm["bk_nama"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Pengarang</td>
                            <td style="width:30px;">:</td>
                            <td><?= $pjm["bk_pengarang"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Penerbit</td>
                            <td style="width:30px;">:</td>
                            <td><?= $pjm["bk_penerbit"];?></td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Tgl. Pinjam</td>
                            <td style="width:30px;">:</td>
                            <td>
                                <?php
                                $tglPinjamRaw = $pjm['pjm_tglpinjam'];
                                $tglPinjam = date("d-m-Y", strtotime($tglPinjamRaw)); 

                                echo $tglPinjam;
                                
                                ;?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Batas Kembali</td>
                            <td style="width:30px;">:</td>
                            <td>
                                <?php
                                $tglBatasRaw = $pjm['pjm_bataskembali'];
                                $tglBatas = date("d-m-Y", strtotime($tglBatasRaw)); 

                                echo $tglBatas;
                                
                                ;?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Tgl. Pengembalian</td>
                            <td style="width:30px;">:</td>
                            <td>
                                <?php
                                $tglKembaliRaw = $pjm['pjm_tglkembali'];
                                

                                if ($tglKembaliRaw == "-"){
                                    echo "-";
                                }else{
                                    $tglKembali = date("d-m-Y", strtotime($tglKembaliRaw)); 
                                    echo $tglKembali;
                                }
                                ;?>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:180px;">Denda</td>
                            <td style="width:30px;">:</td>

                            <?php
                                
                            ?>

                            <td>
                                <?php 
                                    $pinjamstatus = $pjm['pjm_status'];

                                    if ( $pinjamstatus == "Sudah Kembali"){
                                        echo "-";
                                    } else {
                                        $belumkembali = "Belum Kembali";
                                        $denda = query("SELECT pjm_id, CASE WHEN CURDATE() > pjm_bataskembali THEN DATEDIFF(CURDATE(), pjm_bataskembali) * 2000 ELSE 0 END AS jumlah_denda FROM tb_peminjaman WHERE pjm_status = 'Belum Kembali' AND pjm_id = $pjm[pjm_id];")[0];
                                        
                                        echo "Rp." . $denda['jumlah_denda']; 
                                    }
                                
                                ?>

                            </td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-dark" id ="btn_bukukembali">Kembalikan Buku</button>                        
                    <button type="button" class="btn btn-dark" onclick="window.location.href='peminjaman.php'">Kembali</button>                        
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("btn_bukukembali").addEventListener("click", function() {
            // Mendapatkan nilai id dari URL
            var urlParams = new URLSearchParams(window.location.search);
            var id = urlParams.get('id');
            var bookID = document.getElementById('bukuID').value;

            // Meminta konfirmasi dari pengguna
            var confirmation = confirm("Apakah yakin ingin menjalankan fungsi PHP untuk ID " + id + "?");

            // Membuat objek XMLHttpRequest
            var xhttp = new XMLHttpRequest();

            // Menentukan tipe permintaan, URL PHP yang akan dijalankan, dan menggunakan metode POST
            xhttp.open("POST", "peminjaman_bukukembali.php", true);

            // Menetapkan tipe konten untuk permintaan POST
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            // Menangani perubahan status permintaan
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Menangani respons dari server (output PHP)
                    alert(this.responseText);
                }
            };

            // Mengirimkan data dalam badan permintaan, termasuk nilai id
            // xhttp.send("id=" + id + "&confirm=" + (confirmation ? 'yes' : 'no'));
            xhttp.send("id=" + id + "&bookid=" + bookID +"&confirm=" + (confirmation ? 'yes' : 'no'));
        });
    </script>
</body>
</html>