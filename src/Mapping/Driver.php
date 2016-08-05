<?php

/*
 * This file is part of the pavlyshyn/orm package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn\Mapping;

interface Driver {

    public function getTableName($object);

    public function getFields($object);
}
