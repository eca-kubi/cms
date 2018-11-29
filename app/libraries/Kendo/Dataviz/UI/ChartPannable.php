<?php

namespace Kendo\Dataviz\UI;

class ChartPannable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Specifies the key that should be pressed to activate panning. The supported values are: "none" - No key is required.; "ctrl" - The "ctrl" key should be pressed.; "shift" - The "shift" key should be pressed. or "alt" - The "alt" key should be pressed..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPannable
    */
    public function key($value) {
        return $this->setProperty('key', $value);
    }

    /**
    * Specifies an axis that should not be panned. The supported values are none, x and y.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPannable
    */
    public function lock($value) {
        return $this->setProperty('lock', $value);
    }

//<< Properties
}

?>
