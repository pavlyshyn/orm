<?php

namespace Pavlyshyn\DB;

interface Driver {

    public function get($tableName, $id);

    public function getAll($tableName);

    public function update($tableName, array $object);

    public function insert($tableName, array $object);

    public function deleteById($tableName, $id);
    
    public function delete($tableName, $rowname, $value);
    
    public function count($tableName);
    
    public function exist($object, $rowname, $value);
}
