<?php

namespace Kendo\Dataviz\UI;

class ChartLegend extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The legend horizontal alignment when the legend.position is "top" or "bottom" and the vertical alignment when the legend.position is "left" or "right".The supported values are: "start" - the legend is aligned to the start.; "center" - the legend is aligned to the center. or "end" - the legend is aligned to the end..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function align($value) {
        return $this->setProperty('align', $value);
    }

    /**
    * The background color of the legend. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function background($value) {
        return $this->setProperty('background', $value);
    }

    /**
    * The border of the legend.
    * @param \Kendo\Dataviz\UI\ChartLegendBorder|array $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The legend height when the legend.orientation is set to "vertical".
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function height($value) {
        return $this->setProperty('height', $value);
    }

    /**
    * The chart inactive legend items configuration.
    * @param \Kendo\Dataviz\UI\ChartLegendInactiveItems|array $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function inactiveItems($value) {
        return $this->setProperty('inactiveItems', $value);
    }

    /**
    * The chart legend item configuration.
    * @param \Kendo\Dataviz\UI\ChartLegendItem|array $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function item($value) {
        return $this->setProperty('item', $value);
    }

    /**
    * The chart legend label configuration.
    * @param \Kendo\Dataviz\UI\ChartLegendLabels|array $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function labels($value) {
        return $this->setProperty('labels', $value);
    }

    /**
    * The margin of the chart legend. A numeric value will set all paddings.
    * @param float|\Kendo\Dataviz\UI\ChartLegendMargin|array $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function margin($value) {
        return $this->setProperty('margin', $value);
    }

    /**
    * The X offset of the chart legend. The offset is relative to the default position of the legend. For instance, a value of 20 will move the legend 20 pixels to the right of its initial position. A negative value will move the legend to the left of its current position.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function offsetX($value) {
        return $this->setProperty('offsetX', $value);
    }

    /**
    * The Y offset of the chart legend.  The offset is relative to the current position of the legend. For instance, a value of 20 will move the legend 20 pixels down from its initial position. A negative value will move the legend upwards from its current position.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function offsetY($value) {
        return $this->setProperty('offsetY', $value);
    }

    /**
    * The orientation of the legend items.The supported values are: "vertical" - the legend items are added vertically. or "horizontal" - the legend items are added horizontally..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function orientation($value) {
        return $this->setProperty('orientation', $value);
    }

    /**
    * The padding of the chart legend. A numeric value will set all paddings.
    * @param float|\Kendo\Dataviz\UI\ChartLegendPadding|array $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function padding($value) {
        return $this->setProperty('padding', $value);
    }

    /**
    * The positions of the chart legend.The supported values are: "top" - the legend is positioned on the top.; "bottom" - the legend is positioned on the bottom.; "left" - the legend is positioned on the left.; "right" - the legend is positioned on the right. or "custom" - the legend is positioned using legend.offsetX and legend.offsetY..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * If set to true the legend items will be reversed.Available in versions 2013.3.1306 and later.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function reverse($value) {
        return $this->setProperty('reverse', $value);
    }

    /**
    * The spacing between the labels in pixels when the legend.orientation is "horizontal".
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function spacing($value) {
        return $this->setProperty('spacing', $value);
    }

    /**
    * If set to true the chart will display the legend. By default the chart legend is visible.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

    /**
    * The legend width when the legend.orientation is set to "horizontal".
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartLegend
    */
    public function width($value) {
        return $this->setProperty('width', $value);
    }

//<< Properties
}

?>
