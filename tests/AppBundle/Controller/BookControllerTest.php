<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookControllerTest extends WebTestCase
{
    public function testNew()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/new-book');
        $this->assertTrue($client->getResponse()->isOk());
        $form = $crawler->selectButton('OK')->form([
            'book[title]' => 'A test book',
            'book[author]' => '1',
        ]);
        $client->submit($form);
        $crawler = $client->followRedirect();
        $this->assertTrue($client->getResponse()->isOk());
    }
}
