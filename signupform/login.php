<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .main-div{
            width: 18rem;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 10px;
        }
        h1{
            text-align:center;
            margin-top:10px;
        }
        
    </style>
</head>
<body>
<div class="card main-div">
    <?php
    if(isset($_POST["login"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        require_once "dbconnect.php";

        $sql = "SELECT * FROM `registration` WHERE email='$email'";
        $result = mysqli_query($con,$sql);
        $user = mysqli_fetch_array($result,MYSQLI_ASSOC);
        if($user){
            if(password_verify($password,$user['password'])){
                session_start();
                $_SESSION["user"] = "yes";
                header("Location:index.php");
                die();
            }else{
                echo "<div class='alert alert-success'>Password does not match</div>";
            }
        }else{
            echo "<div class='alert alert-success'>Invalid Credentials</div>";

        }

    }

    ?>
<form action = 'login.php' method='POST'>
    <h1>SIGN IN</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary" name="login">Sign In</button>
  </div>
  <div class="text-center">
  <a href="register.php" style="text-decoration:none">New User! Register Here</a>
</div>
</form>
</div>
</body>
</html>
