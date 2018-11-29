<?php

namespace Kendo\Dataviz\UI;

class DiagramConnectionDefaults extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Defines the label displayed on the connection path.
    * @param \Kendo\Dataviz\UI\DiagramConnectionDefaultsContent|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function content($value) {
        return $this->setProperty('content', $value);
    }

    /**
    * Defines the editing behavior of the connections.
    * @param boolean|\Kendo\Dataviz\UI\DiagramConnectionDefaultsEditable|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function editable($value) {
        return $this->setProperty('editable', $value);
    }

    /**
    * The connections end cap configuration. Can be set to a configuration object or a string that represents the endCap.type value.
    * @param string|\Kendo\Dataviz\UI\DiagramConnectionDefaultsEndCap|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function endCap($value) {
        return $this->setProperty('endCap', $value);
    }

    /**
    * Specifies the name of the source shape connector that should be used by default. Valid values are "top", "right", "bottom", "left" and "auto".
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function fromConnector($value) {
        return $this->setProperty('fromConnector', $value);
    }

    /**
    * Defines the default styling that is applied when the user hovers over a connection.
    * @param \Kendo\Dataviz\UI\DiagramConnectionDefaultsHover|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function hover($value) {
        return $this->setProperty('hover', $value);
    }

    /**
    * Specifies if connections can be selected.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function selectable($value) {
        return $this->setProperty('selectable', $value);
    }

    /**
    * Defines the connections selection configuration.
    * @param \Kendo\Dataviz\UI\DiagramConnectionDefaultsSelection|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function selection($value) {
        return $this->setProperty('selection', $value);
    }

    /**
    * The connection start cap configuration or type name.
    * @param string|\Kendo\Dataviz\UI\DiagramConnectionDefaultsStartCap|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function startCap($value) {
        return $this->setProperty('startCap', $value);
    }

    /**
    * Defines the connection line configuration.
    * @param \Kendo\Dataviz\UI\DiagramConnectionDefaultsStroke|array $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function stroke($value) {
        return $this->setProperty('stroke', $value);
    }

    /**
    * Specifies the name of the target shape connector that should be used by default. Valid values are "top", "right", "bottom", "left" and "auto".
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function toConnector($value) {
        return $this->setProperty('toConnector', $value);
    }

    /**
    * The connections type.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramConnectionDefaults
    */
    public function type($value) {
        return $this->setProperty('type', $value);
    }

//<< Properties
}

?>
