<?php

/*
 * This file is part of the pavlyshyn/orm package
 * 
 * @author Roman Pavlyshyn <roman@pavlyshyn.com>
 */

namespace Pavlyshyn;

use Pavlyshyn\Annotation as Reader;

class Entity {

    use \Pavlyshyn\Data\Getter,
        \Pavlyshyn\Data\Setter;

    private $fields = [];

    public function getProperties() {
        $parameters = get_object_vars($this);
        unset($parameters['fields']);
        return $parameters;
    }

    public function getProps() {
        $parameters = get_object_vars($this);
        $reader = Reader::getInstance();
        
        $this->fields = [];
        
        foreach ($parameters as $k => $v) {
            if ($k != 'fields') {
                $t = $reader->init(get_class($this), $k);

                $this->fields[] = [
                    'field' => $k,
                    'value' => $v,
                    'type' => $t->getParameter('var')
                ];
            }
        }

        return $this->fields;
    }

}
