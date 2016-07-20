<?php

namespace Pavlyshyn;

use Pavlyshyn\Annotation as Reader;

class Orm {

    private $driver = null;
    private $reader = null;

    public function __construct(\Pavlyshyn\DB\Driver $driver) {
        $this->driver = $driver;
    }

    public function getTableName($object) {
        $this->reader = Reader::getInstance();
        $t = $this->reader->init(get_class($object));

        return $t->getParameter('tableName');
    }

    public function save($object) {
        $tableName = $this->getTableName($object);
        $props = $object->getProperties();

        if ($this->exist($object, $this->driver->id, $object->getId()) === false) {
            $res = $this->driver->insert($tableName, $props);
        } else {
            $res = $this->driver->update($tableName, $props);
        }

        return $res;
    }

    public function insert($object) {
        $tableName = $this->getTableName($object);
        $props = $object->getProperties();

        return $this->driver->insert($tableName, $props);
    }

    public function update($object) {
        $tableName = $this->getTableName($object);
        $props = $object->getProperties();

        return $this->driver->update($tableName, $props);
    }

    public function get($object) {
        $tableName = $this->getTableName($object);

        $data = $this->driver->get($tableName, $object->getId());

        foreach ($data as $k => $v) {
            $object->$k = $data->$k;
        }

        return $object;
    }

    public function getAll($object) {
        $tableName = $this->getTableName($object);
        $dataArray = $this->driver->getAll($tableName);

        $className = get_class($object);
        $res = [];
        $i = 0;
        foreach ($dataArray as &$data) {
            $res[$i] = new $className();

            foreach ($data as $k => $v) {
                $res[$i]->$k = $data->$k;
            }
            $i++;
        }

        return $res;
    }

    public function deleteById($object) {
        $tableName = $this->getTableName($object);

        return $this->driver->deleteById($tableName, $object->getId());
    }

    public function delete($object, $rowname, $value) {
        $tableName = $this->getTableName($object);

        return $this->driver->delete($tableName, $rowname, $value);
    }

    public function count($object) {
        $tableName = $this->getTableName($object);

        return $this->driver->count($tableName);
    }

    public function exist($object, $rowname, $value) {
        $tableName = $this->getTableName($object);

        return $this->driver->exist($tableName, $rowname, $value);
    }

}
