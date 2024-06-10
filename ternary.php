<?php 

// $loggedIn = true;

// echo ($loggedIn) ? 'You are logged in':'You are not logged in';

// $isRegistered = ($loogedIn == true) ? true:false;
// echo $isRegistered;

$age = 20;
$score = 15;

echo 'Your score is:' .($score > 10 ? ($age >10 ? 'Average':'Exceptional'):($age>10 ? 'Horrible':'Average'));

?>