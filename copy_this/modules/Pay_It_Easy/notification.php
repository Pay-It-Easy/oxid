<?php

require_once dirname(dirname(dirname(__FILE__))) . "/bootstrap.php";
include_once 'controllers/core/Pay_It_EasyCore.php';
$helper =new Pay_It_EasyCore();
include_once 'controllers/Pay_It_EasyConfig.php';
$config =new Pay_It_EasyConfig();
$status=$helper->processPaymentGatewayNotification($_REQUEST, $config);
$config->logTransaction('Notification URL:'.$status['redirecturl']);
echo $status['redirecturl'];
?>