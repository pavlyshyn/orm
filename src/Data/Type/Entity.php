<?php

namespace Pavlyshyn\Data\Type;

use Pavlyshyn\Data\Type;

class Entity extends Type {

    public function __construct($name) {
        parent::__construct($name);
    }

    public function sanitize($value) {
        if ($value instanceof Pavlyshyn\Model) {
            return $value;
        } else {
            return null;
        }
    }

}
