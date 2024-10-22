
<?php
    session_start();
    //cek apakah session sudah dibuat
    if (isset($_SESSION["login"])){
        //jika ada lempar ke dashboard langsung
        header("Location: dashboard.php");
        exit;
    }


    require 'assets/includes/dbconfig.php';
    
    if ( isset($_POST["btn_login"]) ) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        
        $result = mysqli_query($db, "SELECT * FROM tb_login WHERE log_username = '$username'");
        
        //cek username
        if ( mysqli_num_rows($result) === 1 ){
            //cek password
            $row = mysqli_fetch_assoc($result);
            if ( password_verify($password, $row["log_password"]) ){
                
                //Buat Session login
                $_SESSION["login"] = true;
                $_SESSION["info_user"] = $username;
                header("Location: dashboard.php");
                exit;
            }
        }

        $error = true;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20,400,0,0" />


    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/login.css">
</head>
<body>
    <div class="contents">
        <div class="login-form">
            <div class="form-title">
                <h2 class="text-title">Dashboard<br>Perpustakaan</h2>
            </div>
            <div class="form-input">
                
                <div class="form-input-title">
                    <h4>Login</h4>
                </div>
                <div class="form-input-form">
                    <form action="" method="post">
                        <input type="text" name="username" class="form-control" placeholder="Username">
                        <br>
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    
                        
                    <?php if ( isset($error)) :?>
                        <br><center><p style="color: red;">Username atau password salah...</p></center>
                    <?php endif; ?>

                    

                </div>
                
            </div>
            <div class="form-button">
                <button type="submit" name="btn_login" class="btn btn-dark">Login</button>
                </form>
            </div>
        </div>
        <div class="login-picture">
            &nbsp;
        </div>
    </div>
</body>
</html>