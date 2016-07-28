<?php

namespace Pavlyshyn\DB\Iterator;

use \PDO;

class PDOResult implements Pavlyshyn\Data\Iterator {

    private $stmt = null;
    private $result = null;

    public function __construct($pdo, $q) {
        $this->stmt = $pdo->prepare($q);
        $this->stmt->execute();
    }

    public function current() {
        return $this->result;
    }

    public function key() {
        if (!empty($this->result->id)) {
            return $this->result->id;
        }
    }

    public function next() {
        $this->result = $this->stmt->fetch(PDO::FETCH_OBJ, PDO::FETCH_ORI_NEXT);
    }

    public function rewind() {
        $this->result = $this->stmt->fetch(PDO::FETCH_OBJ, PDO::FETCH_ORI_PRIOR);
    }

    public function valid() {
        return ($this->result != null);
    }

}
