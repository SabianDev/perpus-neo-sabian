<?php
    session_start();
    //cek session
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    include_once 'assets/includes/dbconfig.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/peminjaman.css">
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
            
            <div class="contents-mid">
                <table class="table" id="peminjaman">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col" width="20">No.</th>
                            <th scope="col" width="40">ID</th>
                            <th scope="col" width="100">Judul Buku</th>
                            <th scope="col" width="100">NPM Peminjam</th>
                            <th scope="col" width="80">Tgl. Pinjam</th>
                            <th scope="col" width="80">Status</th>
                            <th scope="col" width="40">Denda</th>
                            <th scope="col" width="40">Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         

                        $result = $db->query("SELECT pjm_id,bk_nama,mbr_npm,pjm_tglpinjam,pjm_status,pjm_bataskembali FROM tb_peminjaman INNER JOIN tb_buku ON tb_peminjaman.bk_id = tb_buku.bk_id ORDER BY pjm_id DESC");
                        $num = 1;

                        

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                $tglPinjamRaw = $row['pjm_tglpinjam'];
                                $tglPinjam = date("d-m-Y", strtotime($tglPinjamRaw)); 
                                $tglBatasRaw = $row['pjm_bataskembali'];
                                $tglBatas = date("d-m-Y", strtotime($tglBatasRaw)); 
                                ?>
                                <tr>
                                    <td><?php echo $num ?>.</td>
                                    <td><?php echo $row['pjm_id'] ?></td>
                                    <td><?php echo $row['bk_nama'] ?></td>
                                    <td><?php echo $row['mbr_npm'] ?></td>
                                    <td><?php echo $tglPinjam ?></td>
                                    <td><?php echo $row['pjm_status'] ?></td>
                                    <td>
                                        
                                        <?php

                                        $currentDate = date('Y-m-d');
                                        if ($row['pjm_bataskembali'] < $currentDate){
                                            echo "Ya";
                                        } else {
                                            echo "Tidak";
                                        }

                                        ?>
                                    </td>
                                    <td>
                                        
                                        <div class="container-editdelete">
                                            <!-- <a href="">Ubah</a>|<a href="">Hapus</a> -->
                                            <a class="a-link" href="peminjaman_view.php?id=<?= $row["pjm_id"]; ?>">
                                                <button type="button" class="btn btn-dark">
                                                    View
                                                </button>
                                            </a>
                                            &nbsp;
                                            
                                        </div>
                                    </td>
                                </tr><?php
                                $num = $num+1;
                            }
                        }
                        ?>
                    </tbody>
                </table>
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
            </div>
            
        
        </div>
    </div>
</body>
</html>