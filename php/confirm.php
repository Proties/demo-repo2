<?php 



$subcription->set_type($type);
$subcription->set_initial_amount($intialAmount);
$subcription->set_token($token);
$subcription->set_amount($amount);
$subcription->set_next_run($nextRun);
$subcription->set_frequency($frequency);
$subcription->set_item_name($itemName);
$subcription->set_item_description($itemDescription);
$subcription->set_name_first($firstName);
$subcription->set_name_last($lastName);
$subcription->set_email_address($email);

$subdb=new SubscriptionDB($subcription);
$subdb->addSubscription();
heder('Location: /');
exit();
?>