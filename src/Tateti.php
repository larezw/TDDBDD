<?php

namespace GH;

class Tateti {
	private $tablero = [];
	private $simbolo = '';
	const SIMBOLOS_PERMITIDOS = ['X', 'O'];	

    public function crearTablero() : void
    {
    	for ($i=0; $i < 3; $i++) { 
    		for ($j=0; $j < 3; $j++) { 
    			$this->tablero[$i][$j] = '_';
    		}    		
    	}    	    	
    }

 	public function mostrarTablero() 
 	{
 		return $this->tablero;
 	}

 	public function jugar(int $x, int $y, string $simbolo) : void
 	{
 		if (!$this->celdaOcupada($x,$y) && in_array($simbolo, self::SIMBOLOS_PERMITIDOS) && $simbolo!=$this->simbolo) {
 			$this->tablero[$x][$y] = $simbolo;	
 			$this->simbolo = $simbolo;
 		}
 		
 	}

 	public function getPosicion(int $x,int $y) 
 	{
 		return $this->tablero[$x][$y];
 	}

 	private function celdaOcupada(int $x, int $y)
 	{
 		return ($this->getPosicion($x,$y) != '_');
 	}

 	public function ganoEnFila($fila) 
 	{
 		return ($this->tablero[$fila][0] == $this->tablero[$fila][1] && $this->tablero[$fila][1] == $this->tablero[$fila][2]);
 	}

 	public function ganoEnColumna($columna) 
 	{
 		return ($this->tablero[0][$columna] == $this->tablero[1][$columna] && $this->tablero[1][$columna] == $this->tablero[2][$columna]);
 	}

 	public function ganoEnDiagonal() 
 	{ 		
 		if ($this->tablero[0][0] == $this->tablero[1][1] && $this->tablero[1][1] == $this->tablero[2][2]) {
 			return true;
 		}

 		if ($this->tablero[0][2] == $this->tablero[1][1] && $this->tablero[1][1] == $this->tablero[2][0]) {
 			return true;
 		}

 		return false;
 	}
}