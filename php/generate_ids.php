<?php

//     function generate_ids(){
//         $list = '1234567890abcdefghijklmnopqrstuvwzyABCDEFGHIJKLMNOPQRSTUVWZY';
//         $random = str_shuffle($list);
//         $str = substr($random, 4, 8);
//         return $str;
//     }
//     $i=0;
   
//     $item=array();
//     while($i<1000){
//         $data=generate_ids(); 
//         $len=count($item);
//         for($a=0;$a<$len;$a++){
//             if($item[$a]==$data){
//                 $i--;
//                 return;
//             }
//         }
//         $item[]=$data;
//         $i++;
//    }
//    $f=fopen('ids.json','w');
//    fwrite($f,json_encode($item));
//    fclose($f);


if(!is_dir('../userProfiles/moses')){
    mkdir('../userProfiles/moses','0755',false);

}else{
    print_r('problems');
    return;
    echo 'already exits';
}
?>