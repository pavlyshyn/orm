<?php

namespace Model;

class Model {

    public function getProperties() {
        return get_object_vars($this);
    }

}
