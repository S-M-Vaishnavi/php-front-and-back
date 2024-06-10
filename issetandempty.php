

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>
<body>
    <form action="issetandisempty.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username"><br>
        <label for="password">Password</label>
        <input type="password" name="password"><br>
        <input type="submit" value="login" name="login">
    </form>
</body>
</html>
<?php
 //isset() - Returns TRUE if a variable is declared and not null
 //empty() - Returns TRUE if a variable is not declared , false ,null,""

// foreach($_POST AS $key => $value){
//     echo "{$key} = {$value} <br>";
// }

if(isset($_POST["login"])){
    $username = $_POST["username"];
    $password = $_POST["password"];

    if(empty($username)){
        echo "Username is missing";
    } elseif(empty($password)){
        echo "Password is missing";
    } else{
        echo "hello {$username}";
    }
}
?>