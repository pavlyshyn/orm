<?php

namespace Pavlyshyn;

class Model {

    public function __construct($where = NULL) {
        if (is_numeric($where)) {
            echo 'int';
        } elseif (is_array($where)) {
            echo 'array';
        }
    }

    public function getProperties() {
        return get_object_vars($this);
    }
    
}
