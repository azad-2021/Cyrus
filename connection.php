<?php 

$host1 = "192.168.1.1:9916";  
$user1 = "Ashok";  
$password1 = 'cyrus@123';  


$host = "localhost";  
$user = "root";  
$password = '';  

$db_2 = "cyrusbackend";
$db_3 = "cyrusbilling";
    //$db ="sim";  

$con3 = mysqli_connect($host, $user, $password, $db_2);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con2 = mysqli_connect($host, $user, $password, $db_3);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}

$con = mysqli_connect($host1, $user1, $password1, $db_2);  
if(mysqli_connect_errno()) {  
  die("Failed to connect with MySQL: ". mysqli_connect_error());  
}
?>  