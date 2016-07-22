<?php

namespace Pavlyshyn\Data\Type;

use Pavlyshyn\Data\Type;

class Boolean extends Type {

    public function __construct($name) {
        parent::__construct($name);
    }

    public function sanitize($value) {
        return (is_bool($value)) ? $value : null;
    }

}
