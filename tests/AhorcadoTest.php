<?php

namespace Tests;

final class AhorcadoTest extends \PHPUnit\Framework\TestCase {

    public function test01ClaseExiste() {
        $this->assertTrue(class_exists('\GH\Ahorcado'));
    }

}