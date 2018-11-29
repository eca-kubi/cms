<?php

namespace Kendo\Dataviz\UI;

class DiagramShapeDefaultsFill extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Defines the fill color of the shape.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeDefaultsFill
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * Defines the fill opacity of the shape.
    * @param float $value
    * @return \Kendo\Dataviz\UI\DiagramShapeDefaultsFill
    */
    public function opacity($value) {
        return $this->setProperty('opacity', $value);
    }

    /**
    * Defines the gradient fill of the shape.
    * @param \Kendo\Dataviz\UI\DiagramShapeDefaultsFillGradient|array $value
    * @return \Kendo\Dataviz\UI\DiagramShapeDefaultsFill
    */
    public function gradient($value) {
        return $this->setProperty('gradient', $value);
    }

//<< Properties
}

?>
