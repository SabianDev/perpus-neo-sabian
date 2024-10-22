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
    <title>Member - Import</title>

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
            
            <div class="contents-mid" style="overflow: hidden;">
            
                <div class="contents-mid-upper">
                    <div class="contents-mid-upper-title">
                        <h3>Import Data Member (Excel)</h3>
                    </div>
                    <div class="contents-mid-upper-button">
                        <form action="" enctype="multipart/form-data" method="post">
                            <input type="file" name="excel" required value="" accept="applicationvnd.openxmlformats-officedocument.spreadsheetml.sheet, applicationvnd.ms-excel">
                            <button type="submit" name="import" class="btn btn-dark btn-spacer">Import</button>
                        </form>
                        <button class="btn btn-dark" onclick="window.location.href='member.php'">Kembali</button>
                    </div>
                </div>

                <div class="contents-mid-lower">
                    <table class="table" id="member-import">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" width="80">No.</th>
                                <th scope="col">NPM</th>
                                <th scope="col">NAMA</th>
                                <th scope="col">ANGKATAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $result = $db->query("SELECT * FROM tb_member ORDER BY mbr_npm ASC");
                            $num = 1;
                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td><?php echo $num ?>.</td>
                                        <td><?php echo $row['mbr_npm'] ?></td>
                                        <td><?php echo $row['mbr_nama'] ?></td>
                                        <td><?php echo $row['mbr_angkatan'] ?></td>
                                    </tr><?php
                                    $num = $num+1;
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                    
                </div>
                <?php
                //Import

                if(isset($_POST["import"])){

                    $fileName = $_FILES["excel"]["name"];
			        $fileExtension = explode('.', $fileName);
      		        $fileExtension = strtolower(end($fileExtension));
			        $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			        $targetDirectory = "uploads/" . $newFileName;
			        move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			        error_reporting(0);
			        ini_set('display_errors', 0);

			        require 'excelReader/excel_reader2.php';
			        require 'excelReader/SpreadsheetReader.php';
                    
                    $reader = new SpreadsheetReader($targetDirectory);
			        foreach($reader as $key => $row){
                        
                        //fetch dari excel
                        $impNPM = $row[0];
                        $impNama = $row[1];
                        $impAngkatan = $row[2];

                        //query (data yang sama akan di skip)
                        $queryImport = "INSERT INTO tb_member VALUES ('$impNPM','$impNama','$impAngkatan') ON DUPLICATE KEY UPDATE mbr_npm=mbr_npm";
                    
                        mysqli_query($db,$queryImport);
    
                        
                    }
                    echo
                    "
                    <script>
                    alert('Succesfully Imported');
                    document.location.href = '';
                    </script>
                    ";
                }


                ?>
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