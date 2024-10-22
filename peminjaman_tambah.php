<?php
    session_start();
    //cek session
    if (!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    
    require 'assets/includes/dbconfig.php';


    function tambahPeminjaman($data) {
        global $db;
        $mbr_id = htmlspecialchars($data["mbr_id"]);

        $bk_id = htmlspecialchars($data["bk_id"]);

        $tglPinjam = $data['pjm_tglpinjam'];

        $batasKembali = $data['pjm_bataskembali'];
    
        $bk_status = "Belum Kembali";

        //Cek ketersediaan buku via bk_status di tabel tb_buku
        $query_status = "SELECT bk_status FROM tb_buku WHERE bk_id = $bk_id";
        $result_status = $db->query($query_status);

        //Cegah user untuk tidak meminjam buku yg status nya "Dipinjam"
        if ($result_status->num_rows > 0) {
            // Memeriksa status buku
            $row = $result_status->fetch_assoc();
            $status_buku = $row["bk_status"];
        
            // Jika status buku adalah "Dipinjam", tampilkan pesan
            if ($status_buku == "Dipinjam") {
                echo "<script>
                        alert('Buku sedang dipinjam!.');
                        document.location.href = 'peminjaman_tambah.php';
                      </script>";
            } else {
                // Lakukan proses peminjaman buku
                //query tambah
                $query_tambah = "INSERT INTO tb_peminjaman VALUES ('','$mbr_id','$bk_id', '$tglPinjam','$batasKembali','-','$bk_status')";
                mysqli_query($db,$query_tambah);


                //query update status buku yg dipinjam
                $text_dipinjam = "Dipinjam";
                $query_updatebuku = "UPDATE tb_buku SET bk_status = '$text_dipinjam' WHERE bk_id = $bk_id";
                mysqli_query($db,$query_updatebuku);

                
            }
        } else {
            echo "<script>
                    alert('Buku dengan ID tersebut tidak ditemukan.');
                    document.location.href = 'peminjaman_tambah.php';
                </script>";
        }

        return mysqli_affected_rows($db);
    }

    //submit
    if ( isset($_POST["submit"]) ) {
        
        if( tambahPeminjaman($_POST) > 0 ){
            echo "<script>
                    alert('Data berhasil ditambahkan.');
                    document.location.href = 'peminjaman_tambah.php';
                  </script>";
        }else{
            echo "<script>
                    alert('Error:" . htmlspecialchars(mysqli_error($db)) . "'); 
                    document.location.href = 'peminjaman_tambah.php';
                  </script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peminjaman - Tambah</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>


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
                <h1 class="text-title">Peminjaman Buku</h1>
                <div class="container-contents">
                    <form action="" method="post" style="font-size: 15px;height:100%;">
                        <div class="container-form">
                            <div class="wrapper-01">
                                <div class="ctn-npmPeminjam">
                                    <b>NPM Peminjam</b><br>
                                    <input type="text" class="input-group-text" name="mbr_id" id="mbr_id" required style="width: 100%;" onblur="getMemberDetails()">
                                </div>
                                <div class="ctn-namaPeminjam">
                                    <b>Nama Peminjam</b><br>
                                    <input type="text" class="input-group-text igt-disabled" name="mbr_nama" id="mbr_nama" required style="width: 100%;" readonly>
                                </div>
                                <div class="ctn-angkatan">
                                    <b>Angkatan</b><br>
                                    <input type="text" class="input-group-text igt-disabled" name="mbr_angkatan" id="mbr_angkatan" required style="width: 100%;" readonly>
                                </div>
                            </div>
                            <div class="wrapper-02">
                                <div class="ctn-idBuku">
                                    <b>ID Buku</b><br>
                                    <input type="text" class="input-group-text" name="bk_id" id="bk_id" required style="width: 100%;" onblur="getBookDetails()">
                                </div>
                                <div class="ctn-judulBuku">
                                    <b>Judul Buku</b><br>
                                    <input type="text" class="input-group-text igt-disabled" name="bk_judul" id="bk_judul" required style="width: 100%;" readonly>
                                </div>
                                <div class="ctn-pengarang">
                                    <b>Pengarang</b><br>
                                    <input type="text" class="input-group-text igt-disabled" name="bk_pengarang" id="bk_pengarang" required style="width: 100%;" readonly>
                                </div>
                                <div class="ctn-status">
                                    <b>Status Buku</b><br>
                                    <input type="text" class="input-group-text igt-disabled" name="bk_status" id="bk_status" required style="width: 100%;" readonly>
                                </div>
                            </div>
                            <div class="wrapper-03">
                                <div class="ctn-durasi">
                                    <b>Durasi Pinjam (angka)</b>
                                    <div class="ctn-bottom">
                                    <input type="number" class="input-group-text" name="durasi" id="durasi" required style="width: 80%;">
                                        &nbsp;&nbsp;
                                        <b>hari</b>
                                    </div>
                                </div>
                                <div class="ctn-tglPinjam">
                                    <b>Tanggal Pinjam</b><br>
                                    <div class="ctn-bottom">
                                        <input type="date" class="input-group-text" name="pjm_tglpinjam" id="tglPinjam" required style="width: 100%;" >
                                        &nbsp;&nbsp;

                                        <button type="button" class="btn btn-dark" onclick="kalkulasiPinjam()">=</button>
                                    </div>
                                </div>
                                <div class="ctn-batas">
                                    <b>Batas Waktu Kembali</b><br>
                                    <input type="date" class="input-group-text igt-disabled" name="pjm_bataskembali" id="batasKembali" required style="width: 100%;" readonly>
                                    
                                </div>
                            </div>
                            <div class="wrapper-04">
                                <b>Catatan:</b>
                                <ol>
                                    <li>Denda sebesar Rp.2000/hari dikenakan kepada peminjam jika sudah melewati batas waktu kembali.</li>
                                    <li>Cek kembali data transaksi untuk menghindari kesalahan saat transaksi.</li>
                                    <li>Peminjaman <b>tidak dipungut biaya</b>. Jika ada petugas yang memungut, akan dikenakan sanksi yang berlaku.</li>
                                </ol>
                                <br><br><br>


                                <button type="submit" class="btn btn-dark" name="submit">Pinjam Buku</button>
                                <button type="button" class="btn btn-dark" onclick="window.location.href='peminjaman.php'">Kembali</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        //HANDLE FETCHING BUKU
        function getBookDetails() {
            var bookID = $('#bk_id').val();

            $.ajax({
            type: 'POST',
            url: 'peminjaman_getDetails_book.php', // Create a separate PHP file for handling the AJAX request
            data: { bookID: bookID },
            success: function(response) {
                if (response !== "Book not found") {
                    var bookDetails = JSON.parse(response);
                    $('#bk_judul').val(bookDetails.book_name);
                    $('#bk_pengarang').val(bookDetails.book_author);
                    $('#bk_status').val(bookDetails.book_status);
                } else {
                    // Handle case when book is not found
                    // Display an alert if the book is not found
                    alert("Buku tidak ditemukan untuk ID: " + bookID);
                    $('#bk_judul').val('');
                    $('#bk_pengarang').val('');
                    $('#bk_status').val('');
                }
            }
        });
        }

        //HANDLE FETCHING MEMBER
        function getMemberDetails() {
            var memberID = $('#mbr_id').val();

            $.ajax({
            type: 'POST',
            url: 'peminjaman_getDetails_member.php', // Create a separate PHP file for handling the AJAX request
            data: { memberID: memberID },
            success: function(response) {
                if (response !== "Member not found") {
                    var memberDetails = JSON.parse(response);
                    $('#mbr_nama').val(memberDetails.member_nama);
                    $('#mbr_angkatan').val(memberDetails.member_angkatan);
                } else {
                    // Handle case when book is not found
                    // Display an alert if the book is not found
                    alert("Member tidak ditemukan untuk ID: " + memberID);
                    $('#mbr_nama').val('');
                    $('#mbr_angkatan').val('');
                }
            }
        });
        }

        //HANDLE KALKULASI TANGGAL PINJAM
        function kalkulasiPinjam() {
            var borrowDuration = parseInt(document.getElementById('durasi').value, 10);
            var borrowDate = new Date(document.getElementById('tglPinjam').value);
            
            if (!isNaN(borrowDuration) && borrowDate instanceof Date && !isNaN(borrowDate.getTime())) {
                var borrowLimitDate = new Date(borrowDate);
                borrowLimitDate.setDate(borrowLimitDate.getDate() + borrowDuration);
                
                var formattedBorrowLimitDate = borrowLimitDate.toISOString().split('T')[0];
                document.getElementById('batasKembali').value = formattedBorrowLimitDate;
            } else {
                //Handle in case if the input was invalid.
                alert("Masukkan tanggal pinjam/durasi pinjam yang benar.");
            }
        }

        //disable enter function
        $(document).ready(function() {
            $(window).keydown(function(event){
                if(event.keyCode == 13) {
                event.preventDefault();
                return false;
                }
            });
        });
    </script>
</body>
</html>