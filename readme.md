# **SMS-Activate.ru Api Class**

**Installation**

Download and include the SmsActivator class
```php
require_once 'path/to/SmsActivator.php';
```
Or install via Compsoer
```textmate
composer require furkangm/sms-activate-ru
```

**Usage**

```php
use SmsActivateRu\SmsActivator;

$smsActivator = new SmsActivator('8A0e0fc3549878Aec24fe6A548130204');
```

This class works using action names at https://sms-activate.ru/en/api2. For example get account balance

```php
echo $smsActivator->getBalance();
```