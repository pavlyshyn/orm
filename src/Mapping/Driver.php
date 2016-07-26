<?php

namespace Pavlyshyn\Mapping;

interface Driver {

    public function getTableName();

    public function getFields();
}
