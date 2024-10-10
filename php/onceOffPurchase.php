<?php 
use Insta\Payment\Payment;
use Insta\Database\Payment\PaymentDB;

use Insta\Merchant\Merchant;
use Insta\Database\Merchant\MerchantDB;

switch ($action) {
	case 'purchase_app_item':
		if(!isset($_POST['userID'])){
			
		}

		break;
	case 'purchase_creator_item':
		if(!isset($_POST['creatorID'])){

		}
		if(!isset($_POST['userID'])){

		}

		break;
	default:
		// code...
		break;
}
?>