<?php

/*
 * This file is part of the pavlyshyn/orm package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Data;

class Type {

    use \Pavlyshyn\Data\Getter,
        \Pavlyshyn\Data\Setter;

    protected $name;

    public function __construct($name) {
        $this->name = $name;
    }

    public function sanitize($value) {
        return $value;
    }

    protected function setName($name) {
        $this->name = (string) $name;
    }

    public function getName() {
        return $this->name;
    }

}
