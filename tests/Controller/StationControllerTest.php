<?php

// tests/Controller/StationControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StationControllerTest extends WebTestCase
{


    /**
     * @param $url
     *
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request(
            'GET',
            $url,
            [],
            [],
            ['HTTP_X-AUTH-TOKEN' => 'IBLESCET']
        );

        $this->assertTrue($client->getResponse()->isSuccessful());

        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );
    }

    public function provideUrls()
    {
        return [
            ['/api/V1/stations'],
            ['/api/V1/stations/0001'],
            ['/api/V1/stations/0001/events'],
        ];
    }

}