<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use App\Entity\Product;
use App\Entity\TypeCategory;
use App\Entity\User;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class DemoContext implements Context
{

    /**
     * @Given /^Le compte a comme identifiant "([^"]*)"$/
     */
    public function leCompteACommeIdentifiant($username)
    {
        $this->user = new User();
        $this->user->setUsername($username);
    }


    /**
     * @Given /^Le compte a comme mot de passe "([^"]*)"$/
     */
    public function leCompteACommeMotDePasse($password)
    {
        $this->user->setPassword($password);
    }

    /**
     * @When /^Je donne l’identifiant "([^"]*)"$/
     */
    public function jeDonneLIdentifiant()
    {
        $this->user->getUsername();
    }

    /**
     * @When /^Je donne le mot de passe "([^"]*)"$/
     */
    public function jeDonneLeMotDePasse($arg1)
    {
        $this->user->getPassword();
    }

    /**
     * @Then /^Je suis donc connecté en administrateur$/
     */
    public function jeSuisDoncConnectéEnAdministrateur()
    {
        if (!$this->user->getRoles() == ['ROLE_ADMIN']) {
            throw new \Exception('Connecté en tant que administrateur');
        }
    }

    /**
     * @Given Je suis connecté en administrateur
     */
    public function jeSuisConnecteEnAdministrateur()
    {
        $this->user = new User();

        if (!$this->user->getRoles() == ['ROLE_ADMIN']) {
            throw new \Exception('Connecté en tant que administrateur');
        }
    }

    /**
     * @When /^J’ajoute le produit "([^"]*)"$/
     */
    public function jAjouteLeProduit()
    {
        $name = 'Orangina';
        $price = 2;
        $description = 'c trop bon le Orangina';

        $this->product = new Product();
        $this->product->setName($name);
        $this->product->setDescription($description);
        $this->product->setPrice($price);
    }

    /**
     * @Then /^Le produit "([^"]*)" a été ajouté$/
     */
    public function leProduitAÉtéAjouté()
    {
        if (!$this->product) {
            throw new \Exception('Le produit a été ajouté');
        }
    }
}
