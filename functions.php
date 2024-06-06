<?php
#FUNCTION - Block of code that can be repeatedly called

/*
    Camel Case - myFunction()
    Lower Case - my_function()
    Pascal Case - MyFunction()

*/

// function simpleFunction(){
//     echo 'hello world';
// }
// simpleFunction();

// function passingArguments($name){
//     echo $name;
// }
// passingArguments("Vaishnavi");

// function addNumbers($num1,$num2){
//     return $num1+$num2;
// }
// echo addNumbers(2,3);

//By reference
$myNum = 10;
function addFive($num){
    $num += 10;
}

function addTen(&$num){
    $num +=10;
}

addFive($myNum);
echo "Value: $myNum<br>";

addTen($myNum);
echo "Value: $myNum<br>";

?>