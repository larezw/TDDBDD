<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class WebFeatureContext extends RawMinkContext implements Context
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given que estoy en la página de inicio
     */
    public function queEstoyEnLaPaginaDeInicio()
    {
        $this->visitPath('/');
    }

    /**
     * @Then debo ver :arg1
     */
    public function deboVer($arg1)
    {
        $this->assertSession()->pageTextContains($arg1);
    }

    /**
     * @Then debo ver el formulario para empezar a jugar
     */
    public function deboVerElFormularioParaEmpezarAJugar()
    {
        $sesion = $this->getSession();
        $page = $sesion->getPage();
        
        // $form = $page->find("xpath", "//form");
        $form = $page->find("css", "form");

        // las dos formas son equivalentes
        // $r = $form->has("xpath", "//input[@type='submit']");
        $r = $form->has("css", "input[type=submit]");

        \PHPUnit\Framework\Assert::assertTrue($r);
    }

    /**
     * @When pongo la palabra :arg1 para jugar
     */
    public function pongoLaPalabraParaJugar($arg1)
    {
        $sesion = $this->getSession();
        $page = $sesion->getPage();

        $form = $page->find('css', 'form');
        $input = $form->find('css', 'input[type=text]');
        $input->setValue($arg1);
        $submit = $form->find('css', 'input[type=submit]');
        $page = $submit->click();
    }

    /**
     * @Then llego a la pagina donde voy a jugar
     */
    public function llegoALaPaginaDondeVoyAJugar()
    {
        $currentUrl = $this->getSession()->getCurrentUrl();
        $paths = explode("/", $currentUrl);
        \PHPUnit\Framework\Assert::assertEquals('jugar', $paths[count($paths)-1]);
    }

    /**
     * @Then veo el abecedario para jugar las distintas letras
     */
    public function veoElAbecedarioParaJugarLasDistintasLetras()
    {
        $pagina = $this->getSession()->getPage();
        $links = $pagina->findAll('css', 'a.letrasjugar');
        \PHPUnit\Framework\Assert::assertEquals(26, count($links));
    }

    /**
     * @When juego la letra :arg1
     */
    public function juegoLaLetra($arg1)
    {
        $sesion = $this->getSession();
        $pagina = $sesion->getPage();
        $links = $pagina->findAll('css', "a");
        foreach($links as $link) {
            if (strtolower($link->getText()) == $arg1) {
                $link->click();
                return;
            }
        }
        \PHPUnit\Framework\Assert::fail("Debería jugar una letra valida");
    }
}
