<?php
require 'assets/includes/dbconfig.php';

function registrasi($data){
	global $db;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($db,$data["password"]);
	$password2 = mysqli_real_escape_string($db,$data["password2"]);

	//cek availability username
	$result = mysqli_query($db, "SELECT log_username FROM tb_login WHERE log_username = '$username'");

	if( mysqli_fetch_assoc($result) ){
		echo "<script>alert('username sudah ada')</script>";
		return false;
	}

	//cek konfirmasi password
	if( $password !== $password2 ) {
		echo "<script> alert('konfirmasi salah');</script>";
		return false;
	}

	$password = password_hash($password, PASSWORD_DEFAULT);
	
	//tambah user ke db
	mysqli_query($db, "insert into tb_login values('', '$username','$password')");

	return mysqli_affected_rows($db);

}

if( isset($_POST["register"])){
    if(registrasi($_POST)>0){
        echo "<script>alert('Berhasil Ditambahkan');</script>";
    }else{
        echo mysqli_error($db);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <input type="text" placeholder="username" name="username" id="username"><br>
        <input type="text" placeholder="password" name="password" id="password"><br>
        <input type="text" placeholder="confirm password" name="password2" id="password2"><br>
        <button type="submit" name="register">register</button>
    </form>
</body>
</html>