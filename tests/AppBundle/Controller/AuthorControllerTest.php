<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorControllerTest extends WebTestCase
{
    public function testSearch()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/search-author?q=a');
        $this->assertTrue($client->getResponse()->isOk());
    }

    public function testGetOk()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/get-author/1');
        $this->assertTrue($client->getResponse()->isOk());
    }

    public function testGetInvalid()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/get-author/0');
        $this->assertTrue($client->getResponse()->isClientError());
    }
}
