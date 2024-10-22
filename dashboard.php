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
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />


    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">

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
                <button type="button" class="btn btn-sidemenu-active btn-sidemenu-format" onclick="window.location.href='dashboard.php'">
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
            <div class="contents-top">
                <!-- contents-top -->
                <div class="ovbox">
                    <div class="ovbox-top">
                        <div class="ovbox-top-left">
                            <!-- Isinya otomatis ngitung jumlah rows di table -->
                            <?php
                                $sql = "SELECT * FROM tb_buku WHERE bk_status = 'Dipinjam'";

                                if ($result = mysqli_query($db, $sql)) {

                                    // Return the number of rows in result set
                                    $rowcount = mysqli_num_rows( $result );
                                    
                                    // Display result
                                    printf("%d", $rowcount);
                                 }
                            ?>
                        </div>
                        <div class="ovbox-top-right">
                            <span class="material-symbols-rounded" style="font-size: 60px;">book_2</span>
                        </div>
                    </div>
                    <div class="ovbox-bottom">
                        <h4>Buku Dipinjamkan</h4>
                    </div>
                    
                </div>

                <div class="ovbox">
                    <div class="ovbox-top">
                        <div class="ovbox-top-left">
                            <?php
                                $sql = "SELECT * FROM tb_pengunjung WHERE visitor_date = CURDATE()";

                                if ($result = mysqli_query($db, $sql)) {

                                    // Return the number of rows in result set
                                    $rowcount = mysqli_num_rows( $result );
                                    
                                    // Display result
                                    printf("%d", $rowcount);
                                 }
                            ?>
                        </div>
                        <div class="ovbox-top-right">
                            <span class="material-symbols-rounded" style="font-size: 60px;">group</span>
                        </div>
                    </div>
                    <div class="ovbox-bottom">
                        <h4>Pengunjung Hari Ini</h4>
                    </div>
                    
                </div>

                <div class="ovbox">
                    <div class="ovbox-top">
                        <div class="ovbox-top-left">
                            <!-- Isinya otomatis ngitung jumlah rows di table -->
                            <?php
                                $sql = "SELECT * from tb_member";

                                if ($result = mysqli_query($db, $sql)) {

                                    // Return the number of rows in result set
                                    $rowcount = mysqli_num_rows( $result );
                                    
                                    // Display result
                                    printf("%d", $rowcount);
                                 }
                            ?>
                        </div>
                        <div class="ovbox-top-right">
                            <span class="material-symbols-rounded" style="font-size: 60px;">supervised_user_circle</span>
                        </div>
                    </div>
                    <div class="ovbox-bottom">
                        <h4>Member</h4>
                    </div>
                    
                </div>
            </div>
            <div class="contents-bottom" style="font-size: 14px;">
                <div class="contents-bottom-left">
                    <h4>Highlight Peminjaman  (7 Entri Terakhir)</h4>
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">NPM Peminjam</th>
                                <th scope="col">Judul Buku</th>
                                <th scope="col">Batas Kembali</th>
                                <th scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // $result = $db->query("SELECT * FROM tb_peminjaman ORDER BY pjm_id DESC LIMIT 7");
                            $result = $db->query("SELECT pjm_id,bk_nama,mbr_npm,pjm_tglpinjam,pjm_status,pjm_bataskembali FROM tb_peminjaman INNER JOIN tb_buku ON tb_peminjaman.bk_id = tb_buku.bk_id ORDER BY pjm_tglpinjam DESC LIMIT 7");
                            $num = 1;
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?php echo $num ?></td>
                                        <td><?php echo $row['mbr_npm'] ?></td>
                                        <td><?php echo $row['bk_nama'] ?></td>
                                        <td><?php echo $row['pjm_bataskembali'] ?></td>
                                        <td><?php echo $row['pjm_status'] ?></td>
                                    </tr><?php
                                    $num = $num+1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
                <div class="contents-bottom-right">
                    <div class="bottom-right_up">
                        <div class="right_up_title">
                            <h4>Pengunjung Hari Ini</h4>
                        </div>
                        <div class="right_up_button">
                            <a class="a-link" href="pengunjung_tambah.php">
                                <span class="material-symbols-outlined">
                                    person_add
                                </span>
                            </a>
                            <a class="a-link" href="histori_pengunjung.php">
                                <span class="material-symbols-outlined">
                                    list
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="bottom-right_down">
                    <table class="table">

                        <thead>
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">ID</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $db->query("SELECT * FROM tb_pengunjung WHERE visitor_date = CURDATE() ORDER BY visitor_id ASC LIMIT 7");
                            $num = 1;
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?php echo $num ?></td>
                                        <td><?php echo $row['visitor_id'] ?></td>
                                        <td><?php echo $row['visitor_nama'] ?></td>
                                        <td><?php echo $row['visitor_kelas'] ?></td>
                                    </tr><?php
                                    $num = $num+1;
                                }
                            }
                            ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>