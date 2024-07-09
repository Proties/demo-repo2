<?php declare(strict_types=1);
// reqire 'vendor/phpunit'

use PHPUnit\Framework\TestCase;

$c=curl_init();
curl_setopt($c,CURLOPT_URL, 'localhost:8000/upload_post');
$data=[
	"userID"=>1,
	"username"=>'happy_16',
	"categoryName"=>'happy',
	"location"=>'tshivhumbe123,thohoyandou unit D,0950,Limpopo,SouthAfrica',
	"caption"=>'happy people',
	"img"=>turn_image_to_base64('userProfiles/saule/1cmi6TEG.png'),
	"collaborators"=>[]

];
$f_data=json_encode($data);
curl_setopt($c,CURLOPT_RETURNTRANSFER,true);
curl_setopt($c,CURLOPT_POST,true);
curl_setopt($c,CURLOPT_POSTFIELDS,$f_data);
curl_setopt($c,CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

$rep=curl_exec($c);
curl_close($c);

//takesin image path then turn the image to a 64 bit stirng represantation
function turn_image_to_base64($path){
	//path is a valid image
	
	$data=file_get_contents($path);
	$srting64=base64_encode($data);
	return $srting64;
}

echo $rep;
print_r($rep);
?>