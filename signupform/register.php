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
<?php

if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $phone =$_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repeat_password = $_POST['repeatpassword'];

    $password_hash = password_hash($password,PASSWORD_DEFAULT);

    $errors = array();
    if(empty($name) OR empty($phone) OR empty($email) OR empty($password) OR empty($repeat_password )){
        array_push($errors,"All fields are required");
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        array_push($errors,"Email is not Valid");
    }
    if(strlen($password)<8){
        array_push($errors,"Password must be at least 8 characters long");
    }
    if($password!==$repeat_password){
        array_push($errors,"Passwords do not match");
    }

    if(count($errors)>0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }else{
        require_once "dbconnect.php";
        $insert_query = "INSERT INTO `registration` (name, phone, email, password) VALUES (?,?,?,?)";
        $stmt = mysqli_stmt_init($con);
        $prepareStmt = mysqli_stmt_prepare($stmt, $insert_query);

        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, "ssss", $name, $phone, $email, $password_hash);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>Registered Successfully</div>";
        }else{
            die("Something Went Wrong");
        }
    }
}

?>
<form action='register.php' method='POST'>
    <h1>SIGN UP</h1>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Name</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="name">
    </div> 

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="phone">
    </div>

    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
    </div>

    <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Repeat Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="repeatpassword">
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary" name="submit">Sign Up</button>
    </div>
</form>
</div>
</body>
</html>
