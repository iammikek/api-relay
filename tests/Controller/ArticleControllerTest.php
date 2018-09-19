<?php

// tests/Controller/ArticleControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{

    public function testHomepage()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testHomepageTextExists()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("A U T O M I C A")')->count()
        );
    }


    public function testApi()
    {
        $client = static::createClient();

        $client->request('GET', '/api');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }


    public function testApiText()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("A U T O M I C A. A P I")')->count()
        );
    }
}