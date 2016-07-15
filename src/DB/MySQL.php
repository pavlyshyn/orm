<?php

namespace Pavlyshyn\DB;

class MySQL implements \Pavlyshyn\DB\Driver {

    public $connection = NULL;

    public function __construct($host, $db, $user, $password) {
        try {
            $this->connection = new \PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=UTF8', $user, $password);

            $this->connection->query('SET NAMES utf8;');
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
    }

    public function get($tableName, $id) {

        $query = 'SELECT * FROM `' . $tableName . '` WHERE id = ' . $id;
        $req = $this->connection->prepare($query);
        $req->execute();
        return $req->fetch();
    }

    public function getAll($tableName) {

        $query = 'SELECT * FROM `' . $tableName . '`';
        $req = $this->connection->prepare($query);
        $req->execute();

        return $req->fetchAll();
    }

    public function update($tableName, array $props) {

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
        $req = $this->connection->prepare($query);

        return $req->execute();
    }

    public function insert($tableName, array $props) {

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
        $req = $this->connection->prepare($query);

        return $req->execute();
    }

    public function deleteById($tableName, $id) {

        $query = 'DELETE FROM `' . $tableName . '` WHERE id = ' . $id;
        $req = self::$connection->prepare($query);

        return $req->execute();
    }

}
