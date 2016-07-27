<?php

namespace Pavlyshyn\Mapping;

interface Driver {

    public function getTableName($object);

    public function getFields($object);
}
