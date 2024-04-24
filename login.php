<?php
session_start();
require "functions/function.php";

if (isset($_SESSION["login"]))  {
    $user_id = $_GET["user_id"];
    header("Location: index.php?user_id=  ");
    exit;
}


if(isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query ($conn, "SELECT user_id FROM user WHERE username = '$username'");
    $result2 = mysqli_query ($conn, "SELECT password FROM user WHERE username = '$username'");
    $user_id = userLogin();
    

    //cek username
    if (mysqli_num_rows($result) === 1 ) {
        //cek password
        $row = mysqli_fetch_assoc($result2);
        if(password_verify($password, $row["password"])) {
            //set session

            
            $_SESSION["login"] = true;

            header("Location: index.php?user_id=$user_id[0]");


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
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body style="display:flex;justify-content:center;">

<form action="" method="post" enctype="multipart/form-data" class="shadow-sm p-3 mb-5 bg-body rounded" style="width:30%;display:flex;flex-direction:column;margin-top:150px;">
  <div class="mb-3">
    <h4>Login</h4><br>
    <label for="username" class="form-label">Username</label>
    <input type="text" name="username" class="form-control">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" >
  </div>
  <a href="registrasi.php" class="btn btn-outline-primary">Registrasi</a><br>

<button type="submit" name="login" class="btn btn-primary">Login</button>
</form>
</body>
</html>