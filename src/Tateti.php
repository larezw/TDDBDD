<?php

namespace GH;

class Tateti {
	private $tablero = [];
	private $simbolo = '';
	const JUGADOR = [
		'X' => 'player1',
		'O' => 'player2'
	];
	const SIMBOLOS_PERMITIDOS = ['X', 'O'];

    public function crearTablero() : void {
    	for ($i=0; $i < 3; $i++) { 
    		for ($j=0; $j < 3; $j++) { 
    			$this->tablero[$i][$j] = '_';
    		}
    	}
    }

 	public function mostrarTablero() {
 		return $this->tablero;
 	}

 	public function jugar(int $x, int $y, string $simbolo) : void {
 		if (!$this->celdaOcupada($x,$y) && in_array($simbolo, self::SIMBOLOS_PERMITIDOS) && $simbolo!=$this->simbolo) {
 			$this->tablero[$x][$y] = $simbolo;
 			$this->simbolo = $simbolo;
 		}
 	}

 	public function contarFilas() {
 		return count($this->tablero);
 	}

 	public function contarColumnas() {
 		return (isset($this->tablero[0])) ? count($this->tablero[0]) : 0;
 	}

 	private function celdaOcupada(int $x, int $y) {
 		return ($this->tablero[$x][$y] != '_');
 	}

 	public function ganoEnFila($fila) {
 		if (in_array($this->tablero[$fila][0],self::SIMBOLOS_PERMITIDOS) && $this->tablero[$fila][0] == $this->tablero[$fila][1] && $this->tablero[$fila][1] == $this->tablero[$fila][2]) {
			return self::JUGADOR[$this->tablero[$fila][0]];
		}
		return false;
 	}

 	public function ganoEnColumna($columna) {
 		if (in_array($this->tablero[0][$columna],self::SIMBOLOS_PERMITIDOS) && $this->tablero[0][$columna] == $this->tablero[1][$columna] && $this->tablero[1][$columna] == $this->tablero[2][$columna]) {
 			return self::JUGADOR[$this->tablero[0][$columna]];
 		}
 		return false;
 	}

 	public function ganoEnDiagonal() {
 		if (in_array($this->tablero[0][0],self::SIMBOLOS_PERMITIDOS) &&  $this->tablero[0][0] == $this->tablero[1][1] && $this->tablero[1][1] == $this->tablero[2][2]) {
 			return self::JUGADOR[$this->tablero[0][0]];
 		}

 		if (in_array($this->tablero[0][2],self::SIMBOLOS_PERMITIDOS) && $this->tablero[0][2] == $this->tablero[1][1] && $this->tablero[1][1] == $this->tablero[2][0]) {
 			return self::JUGADOR[$this->tablero[0][2]];
 		}

 		return false;
 	}
}