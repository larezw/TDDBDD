<?php

namespace GH;

class Ahorcado {
	private $palabra;
	private $letrasJugadas = [];
	private $vidas = 5;
	
    public function mostrar()
    {
    	$res = '';
    	for ($i=0; $i < strlen($this->palabra); $i++) {    		
    		if (in_array($this->palabra[$i], $this->letrasJugadas)) {
    			$res .= $this->palabra[$i];	
    		} else {
    			$res .= '_';
    		}    		
    	}
    	return $res;
    }

    public function setPalabra(string $palabra) 
    {
    	$this->palabra = $palabra;
    }

    public function jugar(string $letra)
    {
    	if ($this->vidas > 0 && !in_array($letra, $this->letrasJugadas)) {
    		array_push($this->letrasJugadas, $letra);
	    	if (!$this->verificarJugada($letra)) {
	    		$this->restarVidas();
	    	}
    	}    	
    }

    private function verificarJugada(string $letra) {
    	return in_array($letra, str_split($this->palabra));    	
    }

    private function restarVidas() {
    	$this->vidas--;
    }

    public function getVidas()
    {
    	return $this->vidas;
    }

    public function perdio() {
    	return ($this->vidas == 0);
    }
}