<?php

namespace Kendo\Dataviz\UI;

class ChartSeriesItemOverlay extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The chart series gradient.The supported values are: "glass" (bar, column and candlestick series); "none"; "roundedBevel" (donut and pie series) or "sharpBevel" (donut and pie series).
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemOverlay
    */
    public function gradient($value) {
        return $this->setProperty('gradient', $value);
    }

//<< Properties
}

?>
