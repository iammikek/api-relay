<?php

// tests/Controller/ArticleControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{


    public function provideUrls()
    {
        return [
            ['/', 'A U T O M I C A'],
            ['/api', 'A U T O M I C A . A P I'],
        ];
    }

    /**
     * @param $url
     *
     * @dataProvider provideUrls
     */
    public function testPageIsSuccessful($url)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $this->assertTrue($client->getResponse()->isSuccessful());
    }


    /**
     * @param $url
     * @param $text
     *
     * @dataProvider provideUrls
     */
    public function testTextExists($url, $text)
    {
        $client = self::createClient();
        $client->request('GET', $url);

        $crawler = $client->request('GET', $url);

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("'.$text.'")')->count()
        );
    }
}