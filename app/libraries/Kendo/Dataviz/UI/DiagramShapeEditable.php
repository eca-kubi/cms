<?php

namespace Kendo\Dataviz\UI;

class DiagramShapeEditable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Specifies whether the connectors should appear on hover. If set to false, the user will not be able to create new connections from this shape to other shapes. Also, it will not be possible to change the connector of an existing connection between this and another shape.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\DiagramShapeEditable
    */
    public function connect($value) {
        return $this->setProperty('connect', $value);
    }

    /**
    * Adds DiagramShapeEditableTool to the DiagramShapeEditable.
    * @param \Kendo\Dataviz\UI\DiagramShapeEditableTool|array,... $value one or more DiagramShapeEditableTool to add.
    * @return \Kendo\Dataviz\UI\DiagramShapeEditable
    */
    public function addTool($value) {
        return $this->add('tools', func_get_args());
    }

//<< Properties
}

?>
