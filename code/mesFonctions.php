<?php

function getBdd(){
    return new PDO('mysql:host=localhost;dbname=forum_anime;charset=UTF8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}

function gererGuillemets($string){
    return trim(htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false));
}


function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}


?>​​