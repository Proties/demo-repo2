<?php 
use Insta\Order\Order;
use Insta\Database\Order\OrderDB;
use Insta\Merchant\Merchant;
use Insta\Database\Merchant\MerchantDB;
/**
 * @param array $data
 * @param null $passPhrase
 * @return string
 */
$merchant=new Merchant();
$merchantDB=new MerchantDB($merchant);
$order=new Order();
$orderDB=new OrderDB($order);
if(isset($_SESSION['orderDetails'])){

}
else{
	header('Location: /');
	return;
}
function generateSignature($data, $passPhrase = null) {
    // Create parameter string
    $pfOutput = '';
    foreach( $data as $key => $val ) {
        if($val !== '') {
            $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
        }
    }
    // Remove last ampersand
    $getString = substr( $pfOutput, 0, -1 );
    if( $passPhrase !== null ) {
        $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
    }
    return md5( $getString );
}

// Construct variables
$cartTotal = 100.00; // This amount needs to be sourced from your application
$passphrase = 'jt7NOE43FZPn';
$data = array(
    // Merchant details
    'merchant_id' => '10000100',
    'merchant_key' => '46f0cd694581a',
    'return_url' => 'https://d1a5-102-219-27-117.ngrok-free.app/php/confirm.php',
    'cancel_url' => 'https://d1a5-102-219-27-117.ngrok-free.app/php/deny.php',
    'notify_url' => 'https://d1a5-102-219-27-117.ngrok-free.app/php/redirect.php',
    // Buyer details
    'name_first' => 'First Name',
    'name_last'  => 'Last Name',
    'email_address'=> 'test@test.com',
    // Transaction details
    'm_payment_id' => '1234', //Unique payment ID to pass through to notify_url
    'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
    'item_name' => 'Order#123'
);

$signature = generateSignature($data, $passphrase);
$data['signature'] = $signature;

// If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
$testingMode = true;
$pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
$htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
$htmlForm.='<h1>Checkout Form</h1>';
foreach($data as $name=> $value)
{
    $htmlForm .= '<input name="'.$name.'" type="hidden" value=\''.$value.'\' />';
}

$htmlForm .= '<input type="submit" value="Pay Now" /></form>';
echo $htmlForm;

?>