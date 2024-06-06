<!-- $_GET,$_POST = special variables used to collect data from an HTML form data is sent to the 
                file in the action attribute of <form> 
                <form action="some_file.php" method="get"> -->

<!-- $_GET = Data is appended to the urldecode
        NOT SECURE
        char limit
        Bookmark is possible w/ values
        GET requests can be cached
        Better for a search page
$_POST = Date is packaged inside the body of the HTTP requests
        MORE SECURE
        No data limit
        Cannot Bookmark
        GET requests are not cached
        Better for submitting credentials -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="getandpost.php" method="post">
    <label for="username">USERNAME:</label>
    <input type="text" name="username"><br>
    <label for="password">Password</label>
    <input type="password" name="password"><br>
    <input type="submit" value="Log in">
    </form>   
</body>
</html>
<?php
    echo "{$_POST["username"]} <br>";
    echo "{$_POST["password"]} <br>";

    echo "{$_GET["username"]} <br>";
    echo "{$_GET["password"]} <br>";
?>