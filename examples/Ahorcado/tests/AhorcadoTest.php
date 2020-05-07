<?php

namespace Tests;

final class AhorcadoTest extends \PHPUnit\Framework\TestCase {
    
    public function test01existeLaClasseAhorcado() {
        $this->assertTrue(class_exists('\GlobalHitss\Ahorcado'));
    }

    public function test02PuedoInicialConUnaPalabraSecreta() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $this->assertInstanceOf('\GlobalHitss\Ahorcado', $ahorcado);
    }

    public function test03PuedoVerLaPalabraEscondida() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $palabra = $ahorcado->mostrar();
        $this->assertEquals("___________", $palabra);
    }

    public function test04PuedoVerOtraPalabraEscondida() {
        $ahorcado = new \GlobalHitss\Ahorcado("Talabro");
        $palabra = $ahorcado->mostrar();
        $this->assertEquals("_______", $palabra);
    }

    public function test05PuedoJugarUnaLetra() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $res = $ahorcado->jugar("a");
        $this->assertTrue($res, "Pudimos comprobar que se puede jugar una letra");
    }

    public function test06PuedoJugarUnaLetraYSeMuestraEnLaPalabra() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("a");
        $palabra = $ahorcado->mostrar();
        $this->assertEquals("____a______", $palabra);
    }

    public function test07PuedoJugarUnaLetraYNoImportaSiEsMayuscula() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("A");
        $palabra = $ahorcado->mostrar();
        $this->assertEquals("____a______", $palabra);
    }

    public function test08PuedoJugarMasDeUnaLetraYSeMuestraEnLaPalabra() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("a");
        $ahorcado->jugar("o");
        $ahorcado->jugar("g");
        $palabra = $ahorcado->mostrar();
        $this->assertEquals("G_o_a______", $palabra);
    }

    public function test09NoPuedoJugarAlgoQueNoSeaUnaLetra() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $res = $ahorcado->jugar("Hitss");
        $palabra = $ahorcado->mostrar();
        $this->assertFalse($res, "Pudimos jugar algo mas grande que una letra!");
        $this->assertEquals("___________", $palabra);
    }

    public function test10ElJuegoTieneUnaCantidadDeIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $this->assertEquals(5, $ahorcado->intentosRestantes());
    }

    public function test11SiJuegoUnaLetraQueNoEstaRestaUnIntento() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("z");
        $this->assertEquals(4, $ahorcado->intentosRestantes());
    }

    public function test12SiJuegoDosLetrasQueNoEstaRestaDosIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("z");
        $ahorcado->jugar("m");
        $this->assertEquals(3, $ahorcado->intentosRestantes());
    }

    public function test13SiJuegoUnaLetraQueEstaNoRestaIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("h");
        $this->assertEquals(5, $ahorcado->intentosRestantes());
    }
    
    public function test14SiJuegoLaMismaLetraDosVecesRestaDosIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("z");
        $ahorcado->jugar("z");
        $this->assertEquals(3, $ahorcado->intentosRestantes());
    }
    
    public function test15SiJuegoMuchasLetrasQueNoEstanLlegoACeroIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("z");
        $ahorcado->jugar("m");
        $ahorcado->jugar("c");
        $ahorcado->jugar("f");
        $ahorcado->jugar("x");
        $this->assertEquals(0, $ahorcado->intentosRestantes());
    }
    
    public function test16NoPuedoPasarDeCeroIntentosYJugarDevuelveFalsoAlJugarSinIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("z");
        $ahorcado->jugar("m");
        $ahorcado->jugar("c");
        $ahorcado->jugar("f");
        $ahorcado->jugar("x");
        $res = $ahorcado->jugar("e");
        $this->assertFalse($res);
        $this->assertEquals(0, $ahorcado->intentosRestantes());
    }

    public function test17PodemosPreguntarSiGano() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $res = $ahorcado->gano();
        $this->assertFalse($res);
    }

    public function test18SiTenemosLetrasSinMostrarNosDiceQueNoGano() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("g");
        $ahorcado->jugar("l");
        $ahorcado->jugar("o");
        $res = $ahorcado->gano();
        $this->assertFalse($res);
    }

    public function test19SiJugamosTodasLasLetrasNosDiceQueGano() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("g");
        $ahorcado->jugar("l");
        $ahorcado->jugar("o");
        $ahorcado->jugar("b");
        $ahorcado->jugar("a");
        $ahorcado->jugar("h");
        $ahorcado->jugar("i");
        $ahorcado->jugar("t");
        $ahorcado->jugar("s");
        $res = $ahorcado->gano();
        $this->assertTrue($res);
        $this->assertEquals("GlobalHitss", $ahorcado->mostrar());
    }

    public function test20SiGanamosNoNosTieneQueDejarJugarNingunaLetraMas() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("g");
        $ahorcado->jugar("l");
        $ahorcado->jugar("o");
        $ahorcado->jugar("b");
        $ahorcado->jugar("a");
        $ahorcado->jugar("h");
        $ahorcado->jugar("i");
        $ahorcado->jugar("t");
        $ahorcado->jugar("s");
        
        $res = $ahorcado->jugar("a");
        $this->assertFalse($res);
    }

    public function test21NosQuedamosSinIntentosNoNosTieneQueDejarJugarMas() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("v");
        $ahorcado->jugar("w");
        $ahorcado->jugar("x");
        $ahorcado->jugar("y");
        $ahorcado->jugar("z");
        
        $res = $ahorcado->jugar("a");
        $this->assertFalse($res);
    }

    public function test22NosDiceQueNoPerdimosCuandoArrancamosAJugar() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $this->assertFalse($ahorcado->perdio());
    }

    public function test23NosDiceQuePerdimosSiNosQuedamosSinIntentas() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("v");
        $ahorcado->jugar("w");
        $ahorcado->jugar("x");
        $ahorcado->jugar("y");

        $this->assertFalse($ahorcado->perdio(), "Todavia no perdimos");
        $ahorcado->jugar("z");

        $this->assertTrue($ahorcado->perdio(), "Acá deberíamos haber terminado");
    }

    public function test24NosDiceQueNoTerminamosElJuegoAlEmpezarNosDiceQueNo() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $this->assertFalse($ahorcado->termino());
    }

    public function test25NosDiceQueTerminoElJuegoCuandoNosQuedamosSinIntentos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("v");
        $ahorcado->jugar("w");
        $ahorcado->jugar("x");
        $ahorcado->jugar("y");
        $ahorcado->jugar("z");
        $this->assertTrue($ahorcado->termino());
    }
    
    public function test26NosDiceQueTerminoElJuegoCuandoGanamos() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("g");
        $ahorcado->jugar("l");
        $ahorcado->jugar("o");
        $ahorcado->jugar("b");
        $ahorcado->jugar("a");
        $ahorcado->jugar("h");
        $ahorcado->jugar("i");
        $ahorcado->jugar("t");
        $ahorcado->jugar("s");
        $this->assertTrue($ahorcado->termino());
    }

    public function test27NosDiceQueNoTerminoJuegoALaMitadDeLaPartida() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado->jugar("g");
        $ahorcado->jugar("l");
        $ahorcado->jugar("o");
        $ahorcado->jugar("x");
        $this->assertFalse($ahorcado->termino());
        $this->assertFalse($ahorcado->gano());
        $this->assertFalse($ahorcado->perdio());
    }

    /**
     * Este test se agrego ultimo porque este metodo no existía hasta que
     * se empezo a programar con Slim el frontend y fue necesario xD
     */
    public function test28LaLibreriaNosDaLaPalabraOriginal() {
        $ahorcado = new \GlobalHitss\Ahorcado("GlobalHitss");
        $ahorcado2 = new \GlobalHitss\Ahorcado("GlobalHitss2020");

        $this->assertEquals("GlobalHitss", $ahorcado->palabraOriginal());
        $this->assertEquals("GlobalHitss2020", $ahorcado2->palabraOriginal());
    }
    
}