<h1>
<?php
/*Variables
    -starts with letter and underscore.
    -case sensitive.*/

/*$output = 'Hello World';
$_output1 = "Php world";
echo $output;
echo $_output1;*/

/*Datatypes
    -number
    -string
    -boolean
    -float
    -array
    -object
    -resource*/

/*$String = 'String';
$num = 12;
$float = 4.4;
$bool = true;
echo $String;
echo $num;
echo $float;
echo $bool;*/

// Number Concatenation
/*$num1 = 4;
$num2 = 5;
$sum = $num1 + $num2;
echo $sum;*/

// String Concatenation
// $string1 = "String1";
// $string2 = "String2";
// echo $string1.' '.$string2;
// echo "$string1 $string2";//we can concatenate by using double quotes also
// echo '$string1 $string2'//but in single quotes we cant concatenate and it print as what it had

// $string3 = 'They\'re Here';
// $string4 = "They\"re Here";
// echo $string3;
// echo $string4;

// define('GREETING','Hello Everyone');
// echo GREETING;

// define('LANGUAGES',array(
//     'c','c++','java','python'
// ));
// echo LANGUAGES[3];

$price = 5.99;
$quantity = 4;
$food = "pizza";
echo "You have ordered {$quantity} x {$food}";
$total = $quantity *$price;
echo "The total price is {$total}";


?>
</h1>