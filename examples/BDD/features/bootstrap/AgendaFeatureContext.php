<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use PHPUnit\TextUI\Configuration\PHPUnit;

/**
 * Defines application features from the specific context.
 */
class AgendaFeatureContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct() {
        
    }

    /**
     * @Given que la agenda esta vacia
     */
    public function queLaAgendaEstaVacia()
    {
        $this->phonebook = new \Capacitacion\PhoneBook();
    }

    /**
     * @When listo los contactos
     */
    public function listoLosContactos()
    {
        $this->contacts = $this->phonebook->list();
    }

    /**
     * @Then obtengo :arg1 contactos
     */
    public function obtengoContactos($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals(
            intval($arg1),
            count($this->contacts)
        );
    }

    /**
     * @When agrego el contacto :arg1 con el telefono :arg2
     */
    public function agregoElContactoConElTelefono($arg1, $arg2)
    {
        $this->phonebook->add($arg1, $arg2);
    }

    /**
     * @Then uno de los contactos es :arg1 con el telefono :arg2
     */
    public function unoDeLosContactosEsConElTelefono($arg1, $arg2)
    {
        \PHPUnit\Framework\Assert::assertTrue(
            key_exists($arg1, $this->contacts)
        );
        \PHPUnit\Framework\Assert::assertEquals(
            $arg2,
            $this->contacts[$arg1]
        );
    }

    /**
     * @Given que la agenda tiene los siguientes contactos:
     */
    public function queLaAgendaTieneLosSiguientesContactos(TableNode $table)
    {
        $this->phonebook = new \Capacitacion\PhoneBook();

        foreach ($table as $row) {
            $this->phonebook->add($row['nombre'], $row['telefono']);
        }
    }

    /**
     * @When se borra el contacto :arg1
     */
    public function seBorraElContacto($arg1)
    {
        $this->phonebook->remove($arg1);
    }

    /**
     * @Then el contacto :arg1 no existe
     */
    public function elContactoNoExiste($arg1)
    {
        \PHPUnit\Framework\Assert::assertArrayNotHasKey($arg1, $this->contacts);
    }

    /**
     * @When edito el telefono del contacto :arg1 por :arg2
     */
    public function editoElTelefonoDelContactoPor($arg1, $arg2)
    {
        $this->phonebook->edit($arg1, $arg2);
    }
}
