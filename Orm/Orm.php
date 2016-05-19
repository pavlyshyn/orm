<?php

namespace Orm;

class Orm {

    private static $connection = NULL;

    public static function init($host, $db, $user, $password) {
        try {
            self::$connection = new \PDO('mysql:host=' . $host . ';dbname=' . $db . ';charset=UTF8', $user, $password);

            self::$connection->query("SET NAMES utf8;");
        } catch (\Exception $e) {
            echo 'Erreur(s) lors de la connection a la BDD : ', $e->getMessage(), "\n";
        }
    }

    public static function getConnection() {
        return self::$connection;
    }

    public function save($object) {
        $tableName = $object->getTableNameBdd();
        $props = $object->getProperties();
        
        if ($this->exist($object, 'id', $object->getId()) === false) {
            $tabFields = "INSERT INTO `" . $tableName . "` (";
            $tabFields2 = "";
            $i = 0;
            $count = count($props);
            
            foreach ($props as $key => $value) {
                $tabFields .= "`" . $key . "`";
                $i++;
                if ($i != $count) {
                    $tabFields .= ",";
                }
            }
            $i = 0;
            foreach ($props as $key => $value) {
                $i++;
                if ($key != 'id') {
                    $tabFields2 .= "'" . $value . "'";
                    if ($i != $count) {
                        $tabFields2 .= ", ";
                    }
                }
            }
            $finalRequest = $tabFields . ") VALUES (NULL," . $tabFields2 . ")";
            $query = $finalRequest;
            $req = self::$connection->prepare($query);
            $res = $req->execute();
        } else {
            $tabFields = "UPDATE `" . $tableName . "` SET ";
            $i = 0;
            $count = count($props);
            foreach ($props as $key => $value) {
                $i++;
                if ($key != 'id') {
                    $tabFields .= "`" . $key . "`='" . $value . "'";
                    if ($i != $count) {
                        $tabFields .= ",";
                    }
                }
            }
            $tabFields2 = " WHERE `id`=";
            foreach ($props as $key => $value) {
                if ($key === 'id') {
                    $tabFields2 .= "'" . $value . "'";
                }
            }
            $finalRequest = $tabFields . $tabFields2;
            $query = $finalRequest;
            $req = self::$connection->prepare($query);
            $res = $req->execute();
        }
    }

    public function getAll($object) {
        $tableName = $object->getTableNameBdd();
        $query = "SELECT * FROM `" . $tableName . "`";
        $req = self::$connection->prepare($query);
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }

    public function deleteById($object) {
        $tableName = $object->getTableNameBdd();
        $query = "DELETE FROM `" . $tableName . "` WHERE id = " . $object->getId();
        $req = self::$connection->prepare($query);
        $res = $req->execute();
    }

    public function delete($object, $rowname, $value) {
        $tableName = $object->getTableNameBdd();
        $query = "DELETE FROM `" . $tableName . "` WHERE `" . "$rowname" . "` = " . "'" . $value . "'";
        $req = self::$connection->prepare($query);
        $res = $req->execute();
    }

    public function count($object) {
        $tableName = $object->getTableNameBdd();
        $query = "SELECT COUNT(*) FROM " . $tableName;
        $req = self::$connection->prepare($query);
        $req->execute();
        $res = $req->fetch();
        return $res[0];
    }

    public function exist($object, $rowname, $value) {
        $tableName = $object->getTableNameBdd();
        $query = "SELECT * FROM `" . $tableName . "` WHERE `" . "$rowname" . "` = " . "'" . $value . "'";
        $req = self::$connection->prepare($query);
        $req->execute();
        $res = $req->fetchAll();
        if (!$res) {
            return false;
        } else {
            return true;
        }
    }

}
