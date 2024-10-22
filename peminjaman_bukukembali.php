<?php
session_start();
//cek session
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}

require 'assets/includes/dbconfig.php';



// Memeriksa apakah data POST 'confirm' telah diterima
if (isset($_POST['confirm'])) {
    $id = $_POST['id'];
    $bukuid = $_POST['bookid'];
    $confirmation = $_POST['confirm'];

    // Jika pengguna mengonfirmasi, keluarkan pesan
    if ($confirmation === 'yes') {
        global $db;

        $peminjaman = query("SELECT * FROM tb_peminjaman WHERE pjm_id = $id")[0];
        $buku = query("SELECT * FROM tb_buku WHERE bk_id = $bukuid")[0];

        if ($peminjaman["pjm_status"] == "Sudah Kembali") {
            echo "ALERT : Buku sudah dikembalikan sebelumnya. Aksi dibatalkan.";
        } else {
            $sudah_kembali = "Sudah Kembali";
            $ada = "Ada";
            $currentDate = date('Y-m-d');

            $query = "UPDATE tb_peminjaman SET pjm_status='$sudah_kembali' WHERE pjm_id = $id";
            $query2 = "UPDATE tb_peminjaman SET pjm_tglkembali='$currentDate' WHERE pjm_id = $id";
            $query3 = "UPDATE tb_buku SET bk_status='$ada' WHERE bk_id = $bukuid";
    
            mysqli_query($db,$query);
            mysqli_query($db,$query2);
            mysqli_query($db,$query3);
            
            $currentDate2 = date('d-m-Y');
            echo "Buku dengan ID $bukuid sudah dikembalikan untuk peminjaman dengan ID $id, pada tanggal $currentDate2.";

            
        }
           
    } else {
        echo "Pengembalian buku dibatalkan.";
    }
} else {
    echo "ERROR : Data POST 'confirm' tidak diterima.";
}

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
