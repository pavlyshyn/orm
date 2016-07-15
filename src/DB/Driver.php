<?php

namespace Pavlyshyn\DB;

interface Driver {

    public function get($tableName, $id);

    public function getAll($tableName);

    public function update($tableName, array $object);

    public function insert($tableName, array $object);

    public function deleteById($tableName, $id);
}
