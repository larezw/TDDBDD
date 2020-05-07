<?php

namespace Capacitacion;

class PhoneBook {

    private $contacts = array();

    public function list() {
        return $this->contacts;
    }

    public function add($nombre, $telefono) {
        $this->contacts[$nombre] = $telefono;
    }

    public function remove($nombre) {
        unset($this->contacts[$nombre]);
    }

    public function edit($nombre, $telefono) {
        if (isset($this->contacts[$nombre])){
            $this->contacts[$nombre] = $telefono;
        }
    }
}