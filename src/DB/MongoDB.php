<?php

class MongoDB implements \Pavlyshyn\DB\Driver {

    public $connection = NULL;
    private $options = array(
        'connect' => true,
        'replicaSet' => ''
    );

    public function __construct($host, $dbName, $user = '', $password = '', $options = []) {
        try {
            if (sizeof($options) > 0) {
                array_merge($this->options, $options);
            }

            $dsn = 'mongodb://';

            if ($user != '') {
                $dsn .= $user . ':' . $password . '@' . $host . '/' . $dbName;
            } else {
                $dsn .= $host;
            }

            $db = new \MongoClient($dsn, $this->options);
            $this->connection = $db->selectDB($db);
            return $this->connection;
        } catch (Pavlyshyn\Exception $e) {
            echo 'Error MongoDB connection (' . $e->getCode() . '): ', $e->getMessage(), "\n";
        }
    }

    public function get($collection, $id) {
        $data = $this->selectCollection($collection)->findOne(['_id' => $id]);

        return $data;
    }

    public function getAll($collection, $limit = 1000, $startId = null) {

        $page = (!$startId) ? 1 : ($startId / $limit);

        $result = array();
        $c = $this->selectCollection($collection);

        $cursor = $c->find()->skip(($page - 1) * $limit)->limit($limit);

        foreach ($cursor as $doc) {
            $result[] = $doc;
        }

        return $result;
    }

    public function update($collection, array $object) {
        return $this->save($collection, $object);
    }

    public function insert($collection, array $object) {
        return $this->save($collection, $object);
    }

    public function save($collection, array $object) {
        if ($this->db) {
            $c = $this->selectCollection($collection);

            return $c->insert(json_decode($object));
        }
    }

    public function deleteById($collection, $id) {
        
    }

    public function delete($tableName, $rowname, $value) {
        
    }

    public function count($collection) {
        $count = 0;

        if ($this->db) {
            $c = $this->selectCollection($collection);
            $count = $c->count();
        }

        return $count;
    }

    public function selectCollection($collection) {
        if ($this->db) {
            $c = $this->db->selectCollection($collection);
            return $c;
        }
    }

    public function exist($tableName, $rowname, $value) {
        
    }

}
