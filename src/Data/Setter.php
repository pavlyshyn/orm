<?php

/*
 * This file is part of the pavlyshyn/orm package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Data;

/**
 * Provides writable attributes
 * by replacing the PHP magic __set with a function per property.
 */
Trait Setter {

    final public function __set($name, $value) {
        $method = 'set' . $name;
        if (is_callable([$this, $method])) {
            $this->{$method}($value);
        } else {
            $this->{'__' . $method}($value);
        }
    }

}
