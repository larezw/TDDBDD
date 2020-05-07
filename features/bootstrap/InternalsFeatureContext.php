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
   
    private $tateti;
    private $tablero;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
        $this->tateti = new \GH\Tateti();
    }
    

    /**
     * @Given que empiezo con un tateti
     */
    public function queEmpiezoConUnTateti()
    {
        $this->tateti->crearTablero();      
    }
    
    /**
     * @When muestro el tablero
     */
    public function muestroElTablero()
    {
        $this->tablero = $this->tateti->mostrarTablero();
    }
    

    /**
     * @Then verifico que los tableros sean iguales :arg1 :arg2
     */
    public function verificoQueLosTablerosSeanIguales($arg1, $arg2)
    {
        \PHPUnit\Framework\Assert::assertEquals($this->obtengoLaCantidadDeFilas(), 3);
        \PHPUnit\Framework\Assert::assertEquals($this->obtengoLaCantidadDeColumna(), 3);
        $tableroEsperado = [
            0 => ['_','_','_'],
            1 => ['_','_','_'],
            2 => ['_','_','_']
        ];
       $this->verificoQueLosTablerosSeanIguales($tableroEsperado, $this->muestroElTablero());
       
       \PHPUnit\Framework\Assert::assertEquals($arg1, $arg2);
    }

    /**
     * @Given que empiezo un tateti y juego dos veces
     */
    public function queEmpiezoUnTatetiYJuegoDosVeces()
    {
        throw new PendingException();
    }

    /**
     * @When juego el simbolo :arg1 en la fila :arg2 y la columna :arg3
     */
    public function juegoElSimboloEnLaFilaYLaColumna($arg1, $arg2, $arg3)
    {
        $this->tateti->jugar($arg2,$arg3,$arg1);
    }

    /**
     * @Given que empiezo un tateti y juego un simbolo invalido
     */
    public function queEmpiezoUnTatetiYJuegoUnSimboloInvalido()
    {
        throw new PendingException();
    }

    /**
     * @Given que empiezo un tateti y juego dos simbolos iguales
     */
    public function queEmpiezoUnTatetiYJuegoDosSimbolosIguales()
    {
        throw new PendingException();
    }

    /**
     * @Given que empiezo un tateti y juego dos simbolos en la misma posicion
     */
    public function queEmpiezoUnTatetiYJuegoDosSimbolosEnLaMismaPosicion()
    {
        throw new PendingException();
    }

    /**
     * @Given que empiezo un tateti y juego simbolos para ganar en fila
     */
    public function queEmpiezoUnTatetiYJuegoSimbolosParaGanarEnFila()
    {
        throw new PendingException();
    }

    /**
     * @Then verifico que no gana en columna :arg1
     */
    public function verificoQueNoGanaEnColumna($arg1)
    {
        $this->assertTrue($this->tateti->ganoEnColumna($arg1,$arg2));
    }

    /**
     * @Then verifco que gana en la fila el jugador :arg1 :arg2
     */
    public function verifcoQueGanaEnLaFilaElJugador($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Given que empiezo un tateti y juego simbolos para ganar en columna
     */
    public function queEmpiezoUnTatetiYJuegoSimbolosParaGanarEnColumna()
    {
        throw new PendingException();
    }

    /**
     * @Then verifico que no gana en fila :arg1
     */
    public function verificoQueNoGanaEnFila($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then verifco que gana en la columna el jugador :arg1 :arg2
     */
    public function verifcoQueGanaEnLaColumnaElJugador($arg1, $arg2)
    {
        $this->assertTrue($this->tateti->ganoEnColumna($arg1,$arg2));
    }

    /**
     * @Given que empiezo un tateti y juego simbolos para ganar en diagonal
     */
    public function queEmpiezoUnTatetiYJuegoSimbolosParaGanarEnDiagonal()
    {
        throw new PendingException();
    }

    /**
     * @Then verifco que gana en diagonal el jugador :arg1
     */
    public function verifcoQueGanaEnDiagonalElJugador($arg1)
    {
        \PHPUnit\Framework\Assert::assertTrue($this->tateti->ganoEnDiagonal($arg1));
    }    

    /**
     * @Then verifico la cantidad de filas
     */
    public function verificoLaCantidadDeFilas()
    {
        \PHPUnit\Framework\Assert::assertEquals($this->tateti->contarFilas(), 3);
    }

    /**
     * @Then verifico la cantidad de columna
     */
    public function verificoLaCantidadDeColumna()
    {
        \PHPUnit\Framework\Assert::assertEquals($this->tateti->contarColumnas(), 3);
    }

    /**
     * @Then verifico que el tablero este vacio
     */
    public function verificoQueElTableroEsteVacio()
    {
        $tableroEsperado = [
            0 => ['_','_','_'],
            1 => ['_','_','_'],
            2 => ['_','_','_']
        ];
       \PHPUnit\Framework\Assert::assertEquals($tableroEsperado, $this->tablero);
    }

    /**
     * @Then verifico que hay un :arg1 en la fila :arg2 y la columna :arg3
     */
    public function verificoQueHayUnEnLaFilaYLaColumna($arg1, $arg2, $arg3)
    {

        \PHPUnit\Framework\Assert::assertEquals($arg1, $this->tablero[$arg2][$arg3]);
    }

    /**
     * @Then verifico que no gana en columna :arg1 el jugador :arg2
     */
    public function verificoQueNoGanaEnColumnaElJugador($arg1, $arg2)
    {
        \PHPUnit\Framework\Assert::assertFalse($this->tateti->ganoEnColumna($arg1,$arg2));
    }

    /**
     * @Then verifco que gana en la fila :arg1 el jugador :arg2
     */
    public function verifcoQueGanaEnLaFilaElJugador2($arg1, $arg2)
    {
       \PHPUnit\Framework\Assert::assertTrue($this->tateti->ganoEnFila($arg1,$arg2));
    }

    /**
     * @Then verifico que no gana en fila :arg1 el jugador :arg2
     */
    public function verificoQueNoGanaEnFilaElJugador($arg1, $arg2)
    {
        \PHPUnit\Framework\Assert::assertFalse($this->tateti->ganoEnFila($arg1,$arg2));
    }

    /**
     * @Then verifco que gana en la columna :arg1 el jugador :arg2
     */
    public function verifcoQueGanaEnLaColumnaElJugador2($arg1, $arg2)
    {
        throw new PendingException();
    }
}
