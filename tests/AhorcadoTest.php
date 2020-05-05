<?php

namespace Tests;

final class AhorcadoTest extends \PHPUnit\Framework\TestCase {

    protected function setUp(): void
    {        
	   $this->ahorcado = new \GH\Ahorcado;
    }

    public function test01ClaseExiste() {
        $this->assertTrue(class_exists('\GH\Ahorcado'));
    }
    
	public function test02Mostrar() {
		$this->ahorcado->setPalabra('HOLA');
        $this->assertEquals($this->ahorcado->mostrar(), '____');	
    }

    public function test03JugarExitoso() {
		$this->ahorcado->setPalabra('HOLA');
		$this->ahorcado->jugar('H');
        $this->assertEquals($this->ahorcado->mostrar(), 'H___');	
    }

    public function test04JugarErroneo() {
    	$this->ahorcado->setPalabra('HOLA');
		$this->ahorcado->jugar('F');
        $this->assertEquals($this->ahorcado->mostrar(), '____');
        $this->assertEquals($this->ahorcado->getVidas(), 4);
    }

    public function test05VerificarQuePierda() {
    	$this->ahorcado->setPalabra('HOLA');
		$this->ahorcado->jugar('F');
		$this->ahorcado->jugar('I');
		$this->ahorcado->jugar('M');
		$this->ahorcado->jugar('W'); 
		$this->ahorcado->jugar('G');       
        $this->assertTrue($this->ahorcado->perdio());
    }

     public function test05VerificarQueGane() {
     	$palabra = 'HOLA';
    	$this->ahorcado->setPalabra($palabra);
		$this->ahorcado->jugar('F');
		$this->ahorcado->jugar('H');
		$this->ahorcado->jugar('Y');
		$this->ahorcado->jugar('O');
		$this->ahorcado->jugar('L'); 
		$this->ahorcado->jugar('A');       
        $this->assertEquals($this->ahorcado->mostrar(), $palabra);
        $this->assertEquals($this->ahorcado->getVidas(), 3);
    }
}