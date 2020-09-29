<?php

namespace SmsActivateRu;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\StreamInterface;

/**
 * Class SmsActivator
 * @package SmsActivateRu
 */
class SmsActivator
{

    /** @var string */
    private $endpoint = 'https://sms-activate.ru/stubs/handler_api.php';
    /** @var string|null */
    private $apiKey;
    /** @var ClientInterface */
    private $client;

    public function __construct(?string $apiKey)
    {
        $this->setApiKey($apiKey);
        $this->createInterface();
    }

    /**
     * @return void
     */
    private function createInterface(): void
    {
        $client = new Client();
        $this->setClient($client);
    }

    /**
     * @param ClientInterface $client
     */
    private function setClient(ClientInterface $client): void
    {
        $this->client = $client;
    }

    /**
     * @param int $country
     * @param string $operator
     * @param string $service
     * @param int $forward
     * @param string|null $ref
     * @return string
     * @throws GuzzleException
     */
    public function getNumber(int $country = 0, string $operator = 'megafon', string $service = 'tg', int $forward = 0, ?string $ref = null)
    {
        $params = [
            'country' => $country,
            'operator' => $operator,
            'service' => $service,
            'forward' => $forward
        ];
        if (!is_null($ref))
            $params['ref'] = $ref;
        $response = $this->request(__FUNCTION__, $params);
        return $response->__toString();
    }

    /**
     * @param $action
     * @param array $params
     * @return StreamInterface
     * @throws GuzzleException
     */
    private function request($action, $params = [])
    {
        $params['action'] = $action;
        $params['api_key'] = $this->getApiKey();
        try {
            return $this->getClient()->request('GET', $this->getEndpoint(), ['query' => $params])->getBody();
        } catch (RequestException $requestException) {
            exit('Error: ' . $requestException->getCode());
        }
    }

    /**
     * @return string|null
     */
    public function getApiKey(): ?string
    {
        return $this->apiKey;
    }

    /**
     * @param string|null $apiKey
     */
    public function setApiKey(?string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @return ClientInterface
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * @return string
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * @param $name
     * @param $arguments
     * @return string
     * @throws GuzzleException
     */
    public function __call($name, $arguments)
    {
        $params = $arguments[0] ?? [];
        return $this->request($name, $params)->__toString();
    }

}