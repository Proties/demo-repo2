<?php 
session_start();
use Insta\Order\Order;
use Insta\Users\Users;
use Insta\Database\Order\OrderDB;
use Insta\Merchant\Merchant;


$user=new Users();
$merchant=new Merchant();

$order=new Order();
$order->set_id($_SESSION['orderID']);
$orderDB=new OrderDB($order);
try{
    $orderDB->getOrder();
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
   
    $passphrase = $merchant->get_passphrase();
    $data = array(
        // Merchant details
        'merchant_id' => $merchant->get_id(),
        'merchant_key' => $merchant->get_key(),
        'return_url' => 'https://021f-102-219-27-117.ngrok-free.app/php/confirm.php',
        'cancel_url' => 'hhttps://021f-102-219-27-117.ngrok-free.app/php/deny.php',
        'notify_url' => 'https://021f-102-219-27-117.ngrok-free.app/php/direct.php',
        // Buyer details
        'name_first' => $order->get_userName(),
        'name_last'  => $order->get_userLastName(),
        'email_address'=> $order->get_userEmail(),
        // Transaction details
        'm_payment_id' => $orderDB->order->get_id(), //Unique payment ID to pass through to notify_url
        'amount' => number_format( sprintf( '%.2f', $orderDB->order->get_total() ), 2, '.', '' ),
        'item_name' => $orderDB->order->get_id()
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
    $htmlForm .='<div><h1>Order Details:</h1></div>';
    $htmlForm .='<div><p>Item Name:'.$orderDB->order->get_itemName().'</p>';
    $htmlForm .='<p>Item Description:'.$orderDB->order->get_itemDescription().'</p></div>';
    $htmlForm .= '<input type="submit" value="Pay Now" /></form>';
    echo $htmlForm;

}catch(Exception $err){
    $data['status']='failed';
    $data['message']=$err->getMessage();
    header('Location: /');
    setcookie('checkoutStatus',json_encode($data),time()+(36*10),'/');
    // echo json_encode($data);
}

?>