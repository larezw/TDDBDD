<?php

namespace GlobalHitss;

final class Ahorcado {

    /**
     * @var String
     */
    private $_palabra;

    /**
     * La cantidad de intentos antes de perder, por default es 5
     * 
     * @var Integer
     */
    private $_intentos=5;

    /**
     * Es un arreglo con las letras que se jugaron hasta ahora, donde la key
     * es la letra y el valor es la cantidad de veces que se jugo
     * 
     * @var Array
     */
    private $_letras_jugadas=array();

    /**
     * @var Boolean
     */
    private $_gano=False;
    
    public function __construct($palabra) {
        $this->_palabra = $palabra;
    }

    public function mostrar() {
        $out = "";
        foreach(str_split($this->_palabra) as $letra) {
            if (!empty($this->_letras_jugadas[strtolower($letra)])){
                $out .= $letra;
            } else {
                $out .= "_";
            }
        }
        return $out;
    }

    public function jugar($letra) {
        if (strlen($letra) != 1) {
            return false;
        }
        $_letra = strtolower($letra);

        if ($this->_intentos <= 0 || $this->_gano) {
            return false;
        }

        if (empty($this->_letras_jugadas[$_letra])) {
            $this->_letras_jugadas[$_letra] = 0;
        }
        $this->_letras_jugadas[$_letra] += 1;

        $palabraMinuscula = strtolower($this->_palabra);
        // compruebo si esta la letra o no en la palabra para restar intentos
        if (strpos($palabraMinuscula, $_letra) === False) {
            $this->_intentos -= 1;
        } else {
            // compruebo si ya gano
            $gano = True;
            foreach(str_split($palabraMinuscula) as $letra) {
                // Encadeno un !empty con todas las letras, si uno es falso
                // toda la operacion logica es falsa. Si todas son verdaderas
                // en $gano se guarda un true y es lo que guardo
                $gano = $gano && !empty($this->_letras_jugadas[$letra]);
            }
            $this->_gano = $gano;
        }

        return true;
    }

    public function intentosRestantes() {
        return $this->_intentos;
    }

    public function gano() {
        return $this->_gano;
    }

    public function perdio() {
        return $this->_intentos <= 0;
    }

    public function termino() {
        return $this->perdio() || $this->gano();
    }

    public function palabraOriginal() {
        return $this->_palabra;
    }
}