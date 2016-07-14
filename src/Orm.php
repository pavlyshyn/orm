<?php

namespace Pavlyshyn;

class Orm {

    private static $connection = NULL;

    public static function init($host, $db, $user, $password) {
        try {
            self::$connection = new \PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=UTF8', $user, $password);

            self::$connection->query('SET NAMES utf8;');
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error connection ('.$e->getCode().'): ', $e->getMessage(), "\n";
        }
    }

    public static function getConnection() {
        return self::$connection;
    }

    public function save($object) {
        if ($this->exist($object, 'id', $object->getId()) === false) {
            $res = $this->insert($object);
        } else {
            $res = $this->update($object);
        }
        
        return $res;
    }

    public function insert($object) {
        $tableName = $object->getTableName();
        $props = $object->getProperties();

        $tabFields = 'INSERT INTO `' . $tableName . '` (';
        $tabFields2 = '';

        $i = 0;
        $count = count($props);
        foreach ($props as $key => $value) {
            $tabFields .= '`' . $key . '`';
            $i++;
            if ($i != $count) {
                $tabFields .= ',';
            }
        }

        $i = 0;
        foreach ($props as $key => $value) {
            $i++;
            if ($key != 'id') {
                $tabFields2 .= '\'' . $value . '\'';
                if ($i != $count) {
                    $tabFields2 .= ', ';
                }
            }
        }

        $finalRequest = $tabFields . ') VALUES (NULL,' . $tabFields2 . ')';
        $query = $finalRequest;
        $req = self::$connection->prepare($query);
        
        return $req->execute();
    }

    public function update($object) {
        $tableName = $object->getTableName();
        $props = $object->getProperties();
        
        $tabFields = 'UPDATE `' . $tableName . '` SET ';

        $i = 0;
        $count = count($props);
        foreach ($props as $key => $value) {
            $i++;
            if ($key != 'id') {
                $tabFields .= "`" . $key . '`=\'' . $value . '\'';
                if ($i != $count) {
                    $tabFields .= ',';
                }
            }
        }

        $tabFields2 = ' WHERE `id`=';
        foreach ($props as $key => $value) {
            if ($key === 'id') {
                $tabFields2 .= '\'' . $value . '\'';
            }
        }

        $finalRequest = $tabFields . $tabFields2;
        $query = $finalRequest;
        $req = self::$connection->prepare($query);
        
        return $req->execute();
    }

    public function get(&$object) {
        $tableName = $object->getTableName();
        
        $query = 'SELECT * FROM `' . $tableName . '` WHERE id = ' . $object->getId();
        $req = self::$connection->prepare($query);
        $req->execute();
        return $req->fetch();
    }

    public function getAll($object) {
        $tableName = $object->getTableName();
        
        $query = 'SELECT * FROM `' . $tableName . '`';
        $req = self::$connection->prepare($query);
        $req->execute();
        
        return $req->fetchAll();
    }

    public function deleteById($object) {
        $tableName = $object->getTableName();
        
        $query = 'DELETE FROM `' . $tableName . '` WHERE id = ' . $object->getId();
        $req = self::$connection->prepare($query);
        
        return $req->execute();
    }

    public function delete($object, $rowname, $value) {
        $tableName = $object->getTableName();
        
        $query = 'DELETE FROM `' . $tableName . '` WHERE `' . "$rowname" . '` = ' . '\'' . $value . '\'';
        $req = self::$connection->prepare($query);
        
        return $req->execute();
    }

    public function count($object) {
        $tableName = $object->getTableName();
        
        $query = 'SELECT COUNT(*) as count FROM ' . $tableName;
        $req = self::$connection->prepare($query);
        $req->execute();
        $res = $req->fetch();
        
        return $res['count'];
    }

    public function exist($object, $rowname, $value) {
        $tableName = $object->getTableName();
        
        $query = 'SELECT * FROM `' . $tableName . '` WHERE `' . $rowname . '` = ' . '\'' . $value . '\'';
        $req = self::$connection->prepare($query);
        $req->execute();
        $res = $req->fetchAll();
        
        return (!$res) ? false : true;
    }

}
