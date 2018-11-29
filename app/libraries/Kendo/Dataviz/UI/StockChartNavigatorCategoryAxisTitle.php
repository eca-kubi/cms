<?php

namespace Kendo\Dataviz\UI;

class StockChartNavigatorCategoryAxisTitle extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The background color of the title. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function background($value) {
        return $this->setProperty('background', $value);
    }

    /**
    * The border of the title.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitleBorder|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The text color of the title. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The font style of the title.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function font($value) {
        return $this->setProperty('font', $value);
    }

    /**
    * The margin of the title. A numeric value will set all margins.
    * @param float|\Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitleMargin|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function margin($value) {
        return $this->setProperty('margin', $value);
    }

    /**
    * The padding of the title. A numeric value will set all paddings.
    * @param float|\Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitlePadding|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function padding($value) {
        return $this->setProperty('padding', $value);
    }

    /**
    * The position of the title.The supported values are: "top" - the axis title is positioned on the top (applicable to vertical axis); "bottom" - the axis title is positioned on the bottom (applicable to vertical axis); "left" - the axis title is positioned on the left (applicable to horizontal axis); "right" - the axis title is positioned on the right (applicable to horizontal axis) or "center" - the axis title is positioned in the center.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * The rotation angle of the title. By default the title is not rotated.
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function rotation($value) {
        return $this->setProperty('rotation', $value);
    }

    /**
    * The text of the title.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

    /**
    * If set to true the chart will display the category axis title. By default the category axis title is visible.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

//<< Properties
}

?>
