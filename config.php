<?php

$conn = mysqli_connect("localhost","root","","act1");

function h($str){
    return htmlspecialchars($str ?? '', ENT_QUOTES, 'UTF-8');
}

session_start();
?>