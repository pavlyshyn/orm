<?php

/*
 * This file is part of the pavlyshyn/orm package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Mapping\Driver;

use Pavlyshyn\Mapping\Driver;
use Pavlyshyn\Annotation as Reader;

class Annotation implements Driver {

    private $reader = null;

    public function __construct() {
        $this->reader = Reader::getInstance();
    }

    public function getTableName($object) {
        $t = $this->reader->init(get_class($object));
        return $t->getParameter('tableName');
    }

    public function getFields($object) {
        
    }

}
