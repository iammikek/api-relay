<?php

// tests/Security/SecurityTest.php
namespace App\Tests\Security;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityTest extends WebTestCase
{

    public function testApiRequestsToken()
    {
        $client = self::createClient();
        $client->request('GET', '/api');

        $this->assertEquals($client->getResponse()->getStatusCode(), 401);
    }


    public function testApiPassesWrongToken()
    {
        $client = self::createClient();

        $client->request(
            'GET',
            '/api',
            [],
            [],
            ['HTTP_X-AUTH-TOKEN' => 'FAKE']
        );

        $this->assertEquals($client->getResponse()->getStatusCode(), 403);
    }


    public function testApiPassesCorrectToken()
    {
        $client = self::createClient();

        $client->request(
            'GET',
            '/api',
            [],
            [],
            ['HTTP_X-AUTH-TOKEN' => getenv('APP_SECURITY_TOKEN')]
        );

        $this->assertEquals($client->getResponse()->getStatusCode(), 200);
    }


}