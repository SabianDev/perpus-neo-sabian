<?php
//get ID
require 'assets/includes/dbconfig.php';

$id = $_GET["id"];

if( hapus($id) > 0){
    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'member.php';
          </script>";
    }else{
        echo "<script>
        alert('Error:" . htmlspecialchars(mysqli_error($db)) . "');
        document.location.href = 'member.php';
        </script>"; 
               
    }

function hapus($id) {
    global $db;
    mysqli_query($db, "DELETE FROM tb_member WHERE mbr_npm = $id");
    return mysqli_affected_rows($db);
}

?>