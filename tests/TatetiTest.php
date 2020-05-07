<?php

namespace Tests;

final class TatetiTest extends \PHPUnit\Framework\TestCase {

	protected function setUp(): void {
	   $this->tateti = new \GH\Tateti;
    }

    public function test01ClaseTatetiExiste() {
        $this->assertTrue(class_exists('\GH\Tateti'));
    }

	public function test02CrearTablero() {
		$this->tateti->crearTablero();
        $this->assertEquals($this->tateti->contarFilas(), 3);
        $this->assertEquals($this->tateti->contarColumnas(), 3);
    }

    public function test03Jugar() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');
		$this->tateti->jugar(2,0,'O');
		$tableroEsperado = [
			0 => ['X','_','_'],
			1 => ['_','_','_'],
			2 => ['O','_','_']
		];
		$this->assertEquals($this->tateti->mostrarTablero(), $tableroEsperado);
    }


    public function test04JugarSimboloInvalido() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'Z');
		$tableroEsperado = [
			0 => ['_','_','_'],
			1 => ['_','_','_'],
			2 => ['_','_','_']
		];
        $this->assertEquals($this->tateti->mostrarTablero(), $tableroEsperado);
    }

    public function test05JugarSimboloRepetido() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');
		$this->tateti->jugar(1,0,'X');
		$tableroEsperado = [
			0 => ['X','_','_'],
			1 => ['_','_','_'],
			2 => ['_','_','_']
		];
       	$this->assertEquals($this->tateti->mostrarTablero(), $tableroEsperado);
    }

    public function test06JugarPosicionRepetida() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');
		$this->tateti->jugar(0,0,'X');
		$tableroEsperado = [
			0 => ['X','_','_'],
			1 => ['_','_','_'],
			2 => ['_','_','_']
		];	
		$this->assertEquals($this->tateti->mostrarTablero(), $tableroEsperado);
    }

    public function test07VerificarQueGanaEnFila() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');
		$this->tateti->jugar(2,0,'O');
		$this->tateti->jugar(0,1,'X');
		$this->tateti->jugar(1,0,'O');
		$this->tateti->jugar(0,2,'X');
		$this->assertFalse($this->tateti->ganoEnColumna(0, 'player1'));
        $this->assertTrue($this->tateti->ganoEnFila(0, 'player1'));
    }  

    public function test08VerificarQueGanaEnColumna() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,1,'X');
		$this->tateti->jugar(0,0,'O');
		$this->tateti->jugar(1,1,'X');
		$this->tateti->jugar(1,0,'O');
		$this->tateti->jugar(0,2,'X');
		$this->tateti->jugar(2,0,'O');
		$this->assertFalse($this->tateti->ganoEnFila(0, 'player1'));
        $this->assertTrue($this->tateti->ganoEnColumna(0,'player2'));
    }

    public function test08VerificarQueGanaEnDiagonal() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');
		$this->tateti->jugar(1,0,'O');
		$this->tateti->jugar(1,1,'X');
		$this->tateti->jugar(0,2,'O');
		$this->tateti->jugar(2,2,'X');
        $this->assertTrue($this->tateti->ganoEnDiagonal('player1'));
    }
}