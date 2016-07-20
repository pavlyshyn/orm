<?php

namespace Pavlyshyn\Data;

/**
 * Provides readable attributes
 * by replacing the PHP magic __get with a function per property.
 */
Trait Getter {

    final public function __get($name) {
        $method = 'get' . ucfirst($name);
        if (is_callable([$this, $method])) {
            return $this->{$method}();
        } else {
            return $this->{'__' . $method}();
        }
    }

}
