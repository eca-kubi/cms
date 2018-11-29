<?php

namespace Kendo\Dataviz\UI;

class ChartLegendItem extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The cursor style of the legend item.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartLegendItem
    */
    public function cursor($value) {
        return $this->setProperty('cursor', $value);
    }

    /**
    * Sets the visual option of the ChartLegendItem.
    * A function that can be used to create a custom visual for the legend items. The available argument fields are: options - the item options.; createVisual - a function that can be used to get the default visual.; series - the item series. or pointIndex - the index of the point in the series. Available for pie, donut and funnel series..
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Dataviz\UI\ChartLegendItem
    */
    public function visual($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('visual', $value);
    }

//<< Properties
}

?>
