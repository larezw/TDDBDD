<?php

namespace Tests;

final class TatetiTest extends \PHPUnit\Framework\TestCase {

    public function testClaseTatetiExiste() {
        $this->assertTrue(class_exists('\GH\Tateti'));
    }

}