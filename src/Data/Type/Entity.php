<?php

/*
 * This file is part of the pavlyshyn/orm package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Data\Type;

use Pavlyshyn\Data\Type;
use \Pavlyshyn\Entity;

class Entity extends Type {

    public function __construct($name) {
        parent::__construct($name);
    }

    public function sanitize($value) {
        if ($value instanceof Entity) {
            return $value;
        } else {
            return null;
        }
    }

}
