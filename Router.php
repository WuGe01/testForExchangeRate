<?php
if(substr($_SERVER['REQUEST_URI'], 0, 10) == "/calculate" ){
    include("calculate.php");        
}else{
    header("Location:../index.html");
    exit;
}
?>
