<?php
  $nameError = "";
  $phoneError = "";
  $emailError = "";
  $passwordError = "";

require_once 'connect.php';

if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($name)){
        $nameError = "Name is required";
    } else{
        $name = trim($name);
        $name = htmlspecialchars($name);
        if(!preg_match("/^[a-zA-Z]+$/",$name)){
            $nameError = "<br />Name should contain only char and space";
        }
    } 

    if(empty($phone)){
        $phoneError = "Phone Number is required";
    }  
    if(empty($email)){
        $emailError = "Email is required";
    } 


    if(empty($password)){
        $passwordError = "Password is required";
    } else{
        if(strlen($password) <=8){
            $passwordError = "<br/>At least 8 digits";
        } elseif(preg_match("#[0-9]#",$password)){
            $passwordError = "<br/>At least one digit";

        }elseif(preg_match("#[a-z]#",$password)){
            $passwordError = "<br/>At least one small char";

        }elseif(preg_match("#[A-Z]#",$password)){
            $passwordError = "<br/>At least one captial";
        }else{
            $passwordError = "Password is weak";
        }
    }

    if(!empty($name || $phone || $email || $password)){
        $select_qry = "select * from `registration` where `email`='$email'";
        $result_qry = mysqli_query($con,$select_qry);
        $check_result = mysqli_fetch_row($result_qry);

        if(empty( $check_result)){
            $insert_query = "INSERT INTO `registration` (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')";
            $userCreate = mysqli_query($con, $insert_query);
    
            if($userCreate == true){
                $msg = "Account Create Successfully";
                header('location:login.php?msg='.$msg);
            }
        } else{
            $msg = "User Email Already Registered";
            header("location:signup.php?msg=".$msg);
        }

       
    } else{
        $msg = "All fileds are required";
        header('location:signup.php?msg='.$msg);
    }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    
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
<form action = 'signup.php' method='POST'>
    <h1>SIGN UP</h1>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Name</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
    <span style="color:red;"><?php echo $nameError ?></span>
  </div> 

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Phone Number</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone">
    <span style="color:red;"><?php echo $phoneError ?></span>
  </div>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    <span style="color:red;"><?php echo $emailError ?></span>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    <span style="color:red;"><?php echo $passwordError ?></span>

  </div>
  <div class="text-center">
  <button type="submit" class="btn btn-primary">Sign Up</button>
</div>
</form>
</div>
</body>
</html>
