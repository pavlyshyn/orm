<?php

namespace Pavlyshyn\DB;

interface Transaction {

    public function begin();

    public function commit();

    public function rollBack();
}
