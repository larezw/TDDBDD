<?php

namespace Tests;

final class TatetiTest extends \PHPUnit\Framework\TestCase {

	protected function setUp(): void
    {        
	   $this->tateti = new \GH\Tateti;
    }

    public function test01ClaseTatetiExiste() {
        $this->assertTrue(class_exists('\GH\Tateti'));
    }

	public function test02CrearTablero() {
		$this->tateti->crearTablero();
		$tablero= $this->tateti->mostrarTablero();
        $this->assertEquals(count($tablero), 3);
        $this->assertEquals(count($tablero[0]), 3);
    }

    public function test03Jugar() {
		$this->tateti->crearTablero();		
		$this->tateti->jugar(0,0,'X');	
		$this->tateti->jugar(2,0,'O');		
		$this->assertEquals($this->tateti->getPosicion(0,0), 'X');
		$this->assertEquals($this->tateti->getPosicion(0,1), '_');
		$this->assertEquals($this->tateti->getPosicion(0,2), '_');
		$this->assertEquals($this->tateti->getPosicion(1,0), '_');
		$this->assertEquals($this->tateti->getPosicion(1,1), '_');
		$this->assertEquals($this->tateti->getPosicion(1,2), '_');
		$this->assertEquals($this->tateti->getPosicion(2,0), 'O');
		$this->assertEquals($this->tateti->getPosicion(2,1), '_');
		$this->assertEquals($this->tateti->getPosicion(2,2), '_');        
    } 


    public function test04JugarSimboloInvalido() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'Z');	
        $this->assertEquals($this->tateti->getPosicion(0,0), '_');
		$this->assertEquals($this->tateti->getPosicion(0,1), '_');
		$this->assertEquals($this->tateti->getPosicion(0,2), '_');
		$this->assertEquals($this->tateti->getPosicion(1,0), '_');
		$this->assertEquals($this->tateti->getPosicion(1,1), '_');
		$this->assertEquals($this->tateti->getPosicion(1,2), '_');
		$this->assertEquals($this->tateti->getPosicion(2,0), '_');
		$this->assertEquals($this->tateti->getPosicion(2,1), '_');
		$this->assertEquals($this->tateti->getPosicion(2,2), '_'); 
    }  

    public function test05JugarSimboloRepetido() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');	
		$this->tateti->jugar(1,0,'X');	
        $this->assertEquals($this->tateti->getPosicion(0,0), 'X');
		$this->assertEquals($this->tateti->getPosicion(0,1), '_');
		$this->assertEquals($this->tateti->getPosicion(0,2), '_');
		$this->assertEquals($this->tateti->getPosicion(1,0), '_');
		$this->assertEquals($this->tateti->getPosicion(1,1), '_');
		$this->assertEquals($this->tateti->getPosicion(1,2), '_');
		$this->assertEquals($this->tateti->getPosicion(2,0), '_');
		$this->assertEquals($this->tateti->getPosicion(2,1), '_');
		$this->assertEquals($this->tateti->getPosicion(2,2), '_'); 
    }  

    public function test06JugarPosicionRepetida() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');	
		$this->tateti->jugar(0,0,'X');	
        $this->assertEquals($this->tateti->getPosicion(0,0), 'X');
		$this->assertEquals($this->tateti->getPosicion(0,1), '_');
		$this->assertEquals($this->tateti->getPosicion(0,2), '_');
		$this->assertEquals($this->tateti->getPosicion(1,0), '_');
		$this->assertEquals($this->tateti->getPosicion(1,1), '_');
		$this->assertEquals($this->tateti->getPosicion(1,2), '_');
		$this->assertEquals($this->tateti->getPosicion(2,0), '_');
		$this->assertEquals($this->tateti->getPosicion(2,1), '_');
		$this->assertEquals($this->tateti->getPosicion(2,2), '_'); 
    } 

    public function test07VerificarQueGanaEnFila() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');	
		$this->tateti->jugar(2,0,'O');
		$this->tateti->jugar(0,1,'X');	
		$this->tateti->jugar(1,0,'O');	
		$this->tateti->jugar(0,2,'X');	
		$this->assertFalse($this->tateti->ganoEnColumna(0), 'X');
        $this->assertTrue($this->tateti->ganoEnFila(0), 'X');		
    }  

    public function test08VerificarQueGanaEnColumna() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,1,'X');	
		$this->tateti->jugar(0,0,'O');
		$this->tateti->jugar(1,1,'X');	
		$this->tateti->jugar(1,0,'O');	
		$this->tateti->jugar(0,2,'X');	
		$this->tateti->jugar(2,0,'O');	
        $this->assertTrue($this->tateti->ganoEnColumna(0), 'X');		
    } 

    public function test08VerificarQueGanaEnDiagonal() {
		$this->tateti->crearTablero();
		$this->tateti->jugar(0,0,'X');	
		$this->tateti->jugar(1,0,'O');
		$this->tateti->jugar(1,1,'X');	
		$this->tateti->jugar(0,2,'O');	
		$this->tateti->jugar(2,2,'X');			
        $this->assertTrue($this->tateti->ganoEnDiagonal(0), 'X');		
    } 

}