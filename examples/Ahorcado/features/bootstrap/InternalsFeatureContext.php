<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class InternalsFeatureContext implements Context
{
    /**
     * @var \GlobalHitss\Ahorcado
     */
    private $_ahorcado;

    /**
     * @var String
     */
    private $_palabraOriginal;

    /**
     * @var mixed
     */
    private $_result;

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
     * @Given que empiezo con un ahorcado con la palabra :arg1
     */
    public function queEmpiezoConUnAhorcadoConLaPalabra($arg1)
    {
        $this->_ahorcado = new \GlobalHitss\Ahorcado($arg1);
        $this->_palabraOriginal = $arg1;
    }

    /**
     * @When muestro la palabra
     */
    public function muestroLaPalabra()
    {
        $this->_result = $this->_ahorcado->mostrar();
    }

    /**
     * @Then obtengo la cadena :arg1
     */
    public function obtengoLaCadena($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals($arg1, $this->_result);
    }

    /**
     * @When juego la letra :arg1
     */
    public function juegoLaLetra($arg1)
    {
        $this->_ahorcado->jugar($arg1);
    }

    /**
     * @Then tengo :arg1 intenos disponibles
     */
    public function tengoIntenosDisponibles($arg1)
    {
        \PHPUnit\Framework\Assert::assertEquals($arg1, $this->_ahorcado->intentosRestantes());
    }
    
    /**
     * @Then no gane
     */
    public function noGane()
    {
        \PHPUnit\Framework\Assert::assertFalse($this->_ahorcado->gano());
    }
    
    /**
     * @Then gane
     */
    public function gane()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->_ahorcado->gano());
    }

    /**
     * @Then el juego no termino
     */
    public function elJuegoNoTermino()
    {
        \PHPUnit\Framework\Assert::assertFalse($this->_ahorcado->termino());
    }

    /**
     * @When me quedo sin intentos
     */
    public function meQuedoSinIntentos()
    {
        while($this->_ahorcado->intentosRestantes()>0) {
            // elijo una letra al azar para jugarla y verifico que no sea parte
            // de la palabra original
            $letra = chr(random_int(48, 122));
            if (strpos($this->_palabraOriginal, $letra) === false) {
                $this->_ahorcado->jugar($letra);
            }
        }
    }

    /**
     * @Then el juego termino
     */
    public function elJuegoTermino()
    {
        \PHPUnit\Framework\Assert::assertTrue($this->_ahorcado->termino());
    }

    /**
     * @When y jugue todas las letras correctas
     */
    public function yJugueTodasLasLetrasCorrectas()
    {
        $letrasOriginales = str_split($this->_palabraOriginal);
        $letrasUnicas = array();
        foreach($letrasOriginales as $letra) {
            $letrasUnicas[strtolower($letra)] = true;
        }
        
        // las letras unicas estan guardadas en la key del arreglo
        foreach($letrasUnicas as $letra => $_) {
            $this->_ahorcado->jugar($letra);
        }
    }
}
