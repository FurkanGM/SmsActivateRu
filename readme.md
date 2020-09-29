# **SMS-Activate.ru Api Class**

Example:

```php
use SmsActivateRu\SmsActivator;

$smsActivator = new SmsActivator('8A0e0fc3549878Aec24fe6A548130204');
echo $smsActivator->getPrices(['service' => 'mt', 'country' => 62]) . PHP_EOL;
echo $smsActivator->getBalance() . PHP_EOL;
echo $smsActivator->getNumber();
```