<?php

namespace Pavlyshyn\Data\Type;

use Pavlyshyn\Data\Type;

class Float extends Type {

    public function __construct($name) {
        parent::__construct($name);
    }

    public function sanitize($value) {
        if (!is_scalar($value)) {
            return null;
        }

        if (gettype($value) === "float") {
            return $value;
        } else {
            return (preg_match("/^\\d+\\.\\d+$/", $value) === 1) ? $value : null;
        }
    }

}
