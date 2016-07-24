<?php

namespace Pavlyshyn;

use Pavlyshyn\DB\Driver;
use Pavlyshyn\Annotation as Reader;

class Orm {

    private $driver = null;
    private $reader = null;

    /**
     * @param Pavlyshyn\DB\Driver $driver
     */
    public function __construct(Driver $driver) {
        $this->driver = $driver;
        $this->reader = Reader::getInstance();
    }

    public function getDriver() {
        return $this->driver;
    }

    /**
     * @param Pavlyshyn\Model $object
     */
    public function getTableName($object) {
        $t = $this->reader->init(get_class($object));

        return $t->getParameter('tableName');
    }

    /**
     * @param Pavlyshyn\Model $object
     */
    public function save($object) {
        if ($this->exist($object, $this->getDriver()->id, $object->getId()) === false) {
            $res = $this->insert($object);
        } else {
            $res = $this->update($object);
        }

        return $res;
    }

    /**
     * @param Pavlyshyn\Model $object
     */
    public function insert($object) {
        $tableName = $this->getTableName($object);
        $props = $object->getProperties();

        return $this->getDriver()->insert($tableName, $props);
    }

    /**
     * @param Pavlyshyn\Model $object
     */
    public function update($object) {
        $tableName = $this->getTableName($object);
        $props = $object->getProperties();

        return $this->getDriver()->update($tableName, $props);
    }

    /**
     * @param Pavlyshyn\Model $object
     */
    public function get($object) {
        $tableName = $this->getTableName($object);
        $props = $object->getProperties();
        
        $data = $this->getDriver()->get($tableName, $object->getId());

        if ($data) {
            foreach ($data as $k => $v) {
                $object->$k = $data->$k;
            }
        }

        return $object;
    }

    /**
     * @param Pavlyshyn\Model $object
     */
    public function getAll($object) {
        $tableName = $this->getTableName($object);
        $dataArray = $this->getDriver()->getAll($tableName);
        $props = $object->getProperties();

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

    /**
     * @param Pavlyshyn\Model $object
     */
    public function deleteById($object) {
        $tableName = $this->getTableName($object);

        return $this->getDriver()->deleteById($tableName, $object->getId());
    }

    public function delete($object, $rowname, $value) {
        $tableName = $this->getTableName($object);

        return $this->getDriver()->delete($tableName, $rowname, $value);
    }

    /**
     * @param Pavlyshyn\Model $object
     * 
     * @return integer
     */
    public function count($object) {
        $tableName = $this->getTableName($object);

        return $this->getDriver()->count($tableName);
    }

    public function exist($object, $rowname, $value) {
        $tableName = $this->getTableName($object);

        return $this->getDriver()->exist($tableName, $rowname, $value);
    }

}
