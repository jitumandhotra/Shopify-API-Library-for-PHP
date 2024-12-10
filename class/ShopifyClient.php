<?php
namespace ClientApi;

use Dotenv\Dotenv;
use Shopify\Context;
use Shopify\Auth\FileSessionStorage;
use Shopify\Clients\Rest;

class ShopifyClient
{
    private $client;    
    public function __construct(){
        $this->loadEnvironment();
        $this->initializeShopifyContext();
        $this->client = new Rest($_ENV['SHOP_URL'], $_ENV['ACCESS_TOKEN']);
    }

    private function loadEnvironment(){
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../'); 
        $dotenv->load();
    }

    private function initializeShopifyContext(){
        Context::initialize(
            apiKey: $_ENV['SHOPIFY_API_KEY'],
            apiSecretKey: $_ENV['SHOPIFY_API_SECRET'],
            scopes: $_ENV['SHOPIFY_APP_SCOPES'],
            hostName: $_ENV['SHOPIFY_APP_HOST_NAME'],
            sessionStorage: new FileSessionStorage(__DIR__ . '/../php_sessions')
        );
    }

    public function getClientData($path){
        $response = $this->client->get($path);
        if ($response->getStatusCode() == 200) {
            return $response->getDecodedBody();
        } else {
            throw new \Exception("Error: " . $response->getStatusCode());
        }
    }    
}
