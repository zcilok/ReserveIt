<?php
 $email=$_POST['email'];
 $q=$_POST['q'];
//$iv = mcrypt_create_iv(8, MCRYPT_DEV_RANDOM);
  $salt = "498#2D83B631%3800EBD!801600D*7E3CC13";
  // Create the unique user password reset key
  $password = hash('sha512', $salt.$email);
  if($q==$password){
   echo 1;
  }else{
   echo 0;
  }
?>

