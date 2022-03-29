<?php

include 'session.php';

if (isset($_GET['card'])) {
    $card = base64_decode($_GET['card']);

    echo $card;

    $fileImg='jobcard/'.$card.'.jpg';
    $fileImg2='jobcard/'.$card.'.jpeg';
    $filePdf='jobcard/'.$card.'.pdf';
//echo $fileImg;
    if(file_exists($fileImg)){
        echo 'exist';
        header("location:$fileImg");
    }elseif (file_exists($filePdf)) {
    // code...
        header("location:$filePdf");
    }elseif(file_exists($fileImg2)){
        echo 'exist';
        header("location:$fileImg2");
    }

}elseif(isset($_GET['apid'])){


    $approvalID = $_GET['apid'];

    echo $approvalID;

    $fileImg='InstallationPaper/'.$approvalID.'.jpg';
    $fileImg2='InstallationPaper/'.$approvalID.'.jpeg';
    $filePdf='InstallationPaper/'.$approvalID.'.pdf';
//echo $fileImg;
    if(file_exists($fileImg)){
        echo 'exist';
        header("location:$fileImg");
    }elseif (file_exists($filePdf)) {
    // code...
        header("location:$filePdf");
    }elseif(file_exists($fileImg2)){
        echo 'exist';
        header("location:$fileImg2");
    }

}
?>

