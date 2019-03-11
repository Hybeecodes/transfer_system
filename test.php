<?php  

/**
* Determines whether a number is prime
*
* Determines whether a number is prime
* about the slowest way possible.
* <code>
* for($i=0; $i<100; $i++) {
*
if(is_prime($i)) {
*
echo “ $i is prime\n ” ;
*
}
* }
* </code>
* @param integer
* @return boolean true if prime, false
*/

function is_prime($num)
{
    for($i=2; $i<= (int)sqrt($num); $i++)
    if($num % $i == 0) {
    return false;
    }
}
return true;



?>