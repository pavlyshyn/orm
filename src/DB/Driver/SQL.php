<?php

namespace Pavlyshyn\DB\Driver;

class SQL implements \Pavlyshyn\DB\Driver {

    public $id = 'id';
    public $connection = NULL;

    public function get($tableName, $id) {
        $query = 'SELECT * FROM ' . $tableName . ' WHERE ' . $this->id . ' = ' . $id . ';';
        $req = $this->connection->prepare($query);
        $req->execute();

        return $req->fetchObject();
    }

    public function getAll($tableName) {
        $query = 'SELECT * FROM ' . $tableName . '';
        $req = $this->connection->prepare($query);
        $req->execute();

        return $req->fetchAll(\PDO::FETCH_OBJ);
    }

    public function update($tableName, array $props) {
        $tabFields = 'UPDATE ' . $tableName . ' SET ';

        $i = 0;
        $count = count($props);
        foreach ($props as $key => $value) {
            $i++;
            if ($key != $this->id) {
                $tabFields .= '' . $key . ' = \'' . $value . '\'';
                if ($i != $count) {
                    $tabFields .= ',';
                }
            }
        }

        $tabFields2 = ' WHERE ' . $this->id . '=';
        foreach ($props as $key => $value) {
            if ($key === $this->id) {
                $tabFields2 .= '\'' . $value . '\'';
            }
        }

        $finalRequest = $tabFields . $tabFields2 . ';';
        $query = $finalRequest;
        $req = $this->connection->prepare($query);
        
        return $req->execute();
    }

    public function insert($tableName, array $props) {
        $tabFields = 'INSERT INTO ' . $tableName . ' (';
        $tabFields2 = '';

        $i = 0;
        $count = count($props);
        foreach ($props as $key => $value) {
            
            $tabFields .= '' . $key . '';
            
            if ($key === $this->id) {
                $tabFields2 .= 'NULL';
            }
            else {
                $tabFields2 .= '\'' . $value . '\'';
            }
            
            $i++;
            if ($i != $count) {
                $tabFields .= ',';
                $tabFields2 .= ', ';
            }
        }

        $finalRequest = $tabFields . ') VALUES (' . $tabFields2 . ');';
        $query = $finalRequest;
        $req = $this->connection->prepare($query);

        echo $query;
        
        return $req->execute();
    }

    public function deleteById($tableName, $id) {
        $query = 'DELETE FROM ' . $tableName . ' WHERE ' . $this->id . ' = ' . $id . ';';
        $req = $this->connection->prepare($query);

        return $req->execute();
    }

    public function delete($tableName, $rowname, $value) {
        $query = 'DELETE FROM ' . $tableName . ' WHERE ' . "$rowname" . ' = ' . '\'' . $value . '\';';
        $req = $this->driver->connection->prepare($query);

        return $req->execute();
    }

    public function count($tableName) {
        $query = 'SELECT COUNT('.$this->id.') as count FROM ' . $tableName;
        $req = $this->connection->prepare($query);
        $req->execute();
        $res = $req->fetch();

        return $res['count'];
    }

    public function exist($tableName, $rowname, $value) {
        $query = 'SELECT '.$this->id.' FROM ' . $tableName . ' WHERE ' . $rowname . ' = ' . '\'' . $value . '\';';
        $req = $this->connection->prepare($query);
        $req->execute();
        $res = $req->fetchAll();

        return (!$res) ? false : true;
    }

}
