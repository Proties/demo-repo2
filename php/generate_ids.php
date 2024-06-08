<?php

    function generate_ids(){
        $list = '1234567890abcdefghijklmnopqrstuvwzyABCDEFGHIJKLMNOPQRSTUVWZY';
        $random = str_shuffle($list);
        $str = substr($random, 4, 8);
        $pat='/(\/[a-zA-Z0-9]{4,8})/';
        return $str;
    }
    $i=0;
   
    $item=array();
    while($i<1000){
        $data=generate_ids();
        $item[]=$data;
        $len=count($item);
        for($a=0;$a<$len;$a++){
            if(item[$a]==$data){

                return;
            }
        }
        $i++;
   }
   $f->open('ids.json','w');
   fwrite($f,json_encode($item));
   fclose($f);
?>