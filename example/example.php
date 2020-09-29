<?php

require 'vendor/autoload.php';

use SmsActivateRu\SmsActivator;

$smsActivator = new SmsActivator('8A0e0fc3549878Aec24fe6A548130204');
echo $smsActivator->getPrices(['service' => 'mt', 'country' => 62]);
echo $smsActivator->getBalance();