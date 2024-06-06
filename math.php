<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Calculations of Circle</h1>
    <form action="math.php" method="post">
        <label for="radius">R</label> 
        <input type="text" name="r"><br><br>
        <input type="submit" value="calculate">
    </form>
</body>
</html>
<?php

    //$total = abs($x)
    //$total = round($x)
    //$total = floor($x)
    //$total = ceil($x)
    //$total = sqrt($x)
    //$total = pow($x)
    //$total = max($x,$y,$z)
    //$total = min($x,$y,$z)
    $r = $_POST["r"];
    $pi = pi();
    $cirumcumstance = 2*$pi*$r;
    $area = $pi*pow($r,2);
    $volume = 4/3*$pi*pow($r,3);

    echo "Circumstance: {$cirumcumstance}";
    echo "<br>";
    echo  "Area: {$area}" ;
    echo "<br>";
    echo  "Volume: {$volume}";


?>
<!-- c=2pir -->
<!-- a = pirr -->
<!-- v=4/3pirrr -->