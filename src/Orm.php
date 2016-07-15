<?php

namespace Pavlyshyn;

class Orm {

    private $driver = null;

    public function __construct(\Pavlyshyn\DB\Driver $driver) {
        $this->driver = $driver;
    }

    public function save($object) {
        $tableName = $object->getTableName();
        $props = $object->getProperties();
        
        if ($this->exist($object, 'id', $object->getId()) === false) {
            $res = $this->driver->insert($tableName, $props);
        } else {
            $res = $this->driver->update($tableName, $props);
        }

        return $res;
    }

    public function insert($object) {
        $tableName = $object->getTableName();
        $props = $object->getProperties();

        return $this->driver->insert($tableName, $props);
    }

    public function update($object) {
        $tableName = $object->getTableName();
        $props = $object->getProperties();

        return $this->driver->update($tableName, $props);
    }

    public function get($object) {
        $tableName = $object->getTableName();

        return $this->driver->get($tableName, $object->getId());
    }

    public function getAll($object) {
        $tableName = $object->getTableName();

        return $this->driver->getAll($tableName);
    }

    public function deleteById($object) {
        $tableName = $object->getTableName();
        
        return $this->driver->deleteById($tableName, $object->getId());
    }

    public function delete($object, $rowname, $value) {
        $tableName = $object->getTableName();

        $query = 'DELETE FROM `' . $tableName . '` WHERE `' . "$rowname" . '` = ' . '\'' . $value . '\'';
        $req = $this->driver->connection->prepare($query);

        return $req->execute();
    }

    public function count($object) {
        $tableName = $object->getTableName();

        $query = 'SELECT COUNT(*) as count FROM ' . $tableName;
        $req = $this->driver->connection->prepare($query);
        $req->execute();
        $res = $req->fetch();

        return $res['count'];
    }

    public function exist($object, $rowname, $value) {
        $tableName = $object->getTableName();

        $query = 'SELECT * FROM `' . $tableName . '` WHERE `' . $rowname . '` = ' . '\'' . $value . '\'';
        $req = $this->driver->connection->prepare($query);
        $req->execute();
        $res = $req->fetchAll();

        return (!$res) ? false : true;
    }

}
