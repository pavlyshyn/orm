<?php

namespace Pavlyshyn;

use Pavlyshyn\Annotation as Reader;

class Model {

    use \Pavlyshyn\Data\Getter,
        \Pavlyshyn\Data\Setter;

    private $props = [];

    public function getProperties() {
        $parameters = get_object_vars($this);
        return $parameters;
    }

    public function getProps() {
        $parameters = get_object_vars($this);
        $reader = Reader::getInstance();

        foreach ($parameters as $k => $v) {
            if ($k != 'props') {
                $t = $reader->init(get_class($this), $k);

                $this->props[] = [
                    'field' => $k,
                    'value' => $v,
                    'type' => $t->getParameter('var')
                ];
            }
        }

        return $this->props;
    }

}
