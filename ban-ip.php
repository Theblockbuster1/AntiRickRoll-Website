<?php 
$deny = array(
"41.199.140.206",


);

if (in_array ($_SERVER['REMOTE_ADDR'], $deny)) {
   header("location: https://m.youtube.com/watch?v=dQw4w9WgXcQ");
   exit();
} 

?>
