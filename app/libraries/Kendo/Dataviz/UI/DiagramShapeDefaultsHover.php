<?php

namespace Kendo\Dataviz\UI;

class DiagramShapeDefaultsHover extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Defines the hover fill options.
    * @param string|\Kendo\Dataviz\UI\DiagramShapeDefaultsHoverFill|array $value
    * @return \Kendo\Dataviz\UI\DiagramShapeDefaultsHover
    */
    public function fill($value) {
        return $this->setProperty('fill', $value);
    }

//<< Properties
}

?>
