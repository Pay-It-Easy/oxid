<?php

$sMetadataVersion = '1.1';
$aModule = array(
		'id' => 'Pay_It_Easy',
		'title' => 'Pay_It_Easy',
		'description' => 'Pay_It_Easy Payment',
		'thumbnail' => 'logo.png',
		'version' => '1.5',
		'author' => 'Pay_It_Easy ',
		'url' => '',
		'email' => '',
		'extend' => array(
				'oxorder' => 'Pay_It_Easy/controllers/Pay_It_Easy_order',
				'payment' => 'Pay_It_Easy/controllers/Pay_It_Easy_payment',
				'oxpaymentgateway' =>'Pay_It_Easy/controllers/Pay_It_Easy_paymentgateway'
		),
		'files' => array(
				'Pay_It_Easy_configuration' => 'Pay_It_Easy/controllers/admin/Pay_It_Easy_configuration.php',
				'Pay_It_Easy_redirect' => 'Pay_It_Easy/controllers/Pay_It_Easy_redirect.php',
		),
		'templates' => array(
				'Pay_It_Easy_configuration.tpl' => 'Pay_It_Easy/views/admin/tpl/Pay_It_Easy_configuration.tpl',
				'Pay_It_Easy_redirect.tpl' => 'Pay_It_Easy/views/tpl/Pay_It_Easy_redirect.tpl'
		)
);
