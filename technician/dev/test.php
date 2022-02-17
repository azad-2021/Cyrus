<?php
$filePath = '/jobcard/test.pdf';
  
/* Store the path of destination file */
$destinationFilePath = '/ftp://192.168.1.252/onlinejobcard/test.pdf';

if( !rename($filePath, $destinationFilePath) ) {  
    echo "File can't be moved!";  
}  
else {  
    echo "File has been moved!";  
}
?>

