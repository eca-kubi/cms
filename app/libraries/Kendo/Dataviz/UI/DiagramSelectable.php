<?php

namespace Kendo\Dataviz\UI;

class DiagramSelectable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Specifies if the multiple selection should be enabled.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\DiagramSelectable
    */
    public function multiple($value) {
        return $this->setProperty('multiple', $value);
    }

    /**
    * Defines the selection line configuration.
    * @param \Kendo\Dataviz\UI\DiagramSelectableStroke|array $value
    * @return \Kendo\Dataviz\UI\DiagramSelectable
    */
    public function stroke($value) {
        return $this->setProperty('stroke', $value);
    }

    /**
    * The selectable key.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramSelectable
    */
    public function key($value) {
        return $this->setProperty('key', $value);
    }

//<< Properties
}

?>
