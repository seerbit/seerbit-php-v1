<?php
ini_set("display_errors", 1);

use Seerbit\Client;
use Seerbit\Service\Recurrent\RecurrentService;

require __DIR__ . '/../../../vendor/autoload.php';

try {
    $token = "1KWLzpZkWaoXO9AN4qweKwqLjGcQSNt8kjeVjsdTG4lPlwg6sTvpVAay2RA7hoCEzHPkIQa+MNfDepx4VBr5JMgLb5Q5anq9XoN2pXU850bumqBWFVw1T1ZW5w8N+Sq/";
    //Instantiate SeerBit Client
    $client = new Client();

    //Configure SeerBit Client
    $client->setToken($token);
    $client->setEnvironment(\Seerbit\Environment::LIVE);
    $client->setAuthType(\Seerbit\AuthType::BEARER);

    //SETUP CREDENTIALS
    $client->setPublicKey("SBTESTPUBK_p8GqvFSFNCBahSJinczKd9aIPoRUZfda");
    $client->setSecretKey("SBTESTSECK_kFgKytQK1KSvbR616rUMqNYOUedK3Btm5igZgxaZ");

    //Instantiate Mobile Money Service
    $service = New RecurrentService($client);

    //Build PayLoad
    $data = '{ 
        "amount":"20",
        "currency":"NGN",
        "country":"NG",
        "status":"INACTIVE",
        "email":"johndoe@gmail.com",
        "billingId":"199721652416534",
        "mobileNumber":"09339993322"
        }';

    //Decode to associated array
    $payload = json_decode($data, true);

    $transaction = $service->UpdateSubscription($payload);

    header('Content-Type: application/json');
    echo($transaction->toJson());


} catch (\Exception $exception) {
    echo $exception->getMessage();
}