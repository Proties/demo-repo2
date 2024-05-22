<?php
$file_one='generated_ids.php';
$file_two='used_ids.php';
$arrayIds;
function generate_ids(){
    $list = '1234567890abcdefghijklmnopqrstuvwzyABCDEFGHIJKLMNOPQRSTUVWZY';
    $random = str_shuffle($list);
    $str = substr($random, 5, 13);
}
function check_duplicate(){}
function remove_id(){}
?>