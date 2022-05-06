<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testHomepageIsUp()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("form")')->count());
    }

    public function testRegister()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/register');

        $form = $crawler->selectButton("S'inscrire")->form();
        $form['registration_form[username]'] = 'John Test';
        $form['registration_form[plainPassword]'] = 'Mot de passe';
        $form['registration_form[agreeTerms]'] = true;

        $crawler = $client->submit($form);
        $crawler = $client->followRedirect(true);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        echo $client->getResponse()->getContent();
    }
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton("Se connecter")->form();
        $form['username'] = 'admin';
        $form['password'] = 'root';


        $crawler = $client->submit($form);
        $crawler = $client->followRedirect(true);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());




        echo $client->getResponse()->getContent();
    }
    public function testAddProduct()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form = $crawler->selectButton("Se connecter")->form();
        $form['username'] = 'admin';
        $form['password'] = 'root';


        $crawler = $client->submit($form);
        $crawler = $client->followRedirect(true);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $crawler = $client->request('GET', '/admin/addproduct');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $formAdd = $crawler->selectButton("Ajouter")->form();
        $formAdd['form[name]'] = 'Produit test';
        $formAdd['form[description]'] = 'Le super produit test';
        $formAdd['form[price]'] = '42000';
        $formAdd['form[productType]'] = 17;
        $formAdd['form[category]'] = 35;
        $crawler = $client->submit($formAdd);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());



        echo $client->getResponse()->getContent();
    }
}
