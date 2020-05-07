<?php

namespace Tests;

class Calculadora {
    public function multiplicar($a, $b) {
        return $a * $b;
    }
    public function multiplicar2($a, $b) {
        $r = 0;
        while ($b > 0) {
            $r = $r + $a;
            $b = $b - 1;
        }
        return $r;
    }
}

final class AhorcadoTest extends \PHPUnit\Framework\TestCase {
    
    public function test01Multiplico2Por3() {
        $calc = new Calculadora();
        $result = $calc->multiplicar(2, 3);

        $this->assertEquals(6, $result);
    }

}