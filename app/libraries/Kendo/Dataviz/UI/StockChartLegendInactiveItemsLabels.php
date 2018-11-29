<?php

namespace Kendo\Dataviz\UI;

class StockChartLegendInactiveItemsLabels extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The color of the labels. Any valid CSS color string will work here, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartLegendInactiveItemsLabels
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The font style of the labels.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartLegendInactiveItemsLabels
    */
    public function font($value) {
        return $this->setProperty('font', $value);
    }

    /**
    * Sets the template option of the StockChartLegendInactiveItemsLabels.
    * The template which renders the labels.The fields which can be used in the template are: text - the text the legend item.; series - the data series.; value - the point value. (only for donut and pie charts); percentage - the point value represented as a percentage value. Available only for 100% stacked charts. or dataItem - the original data item used to construct the point..
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\StockChartLegendInactiveItemsLabels
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the StockChartLegendInactiveItemsLabels.
    * The template which renders the labels.The fields which can be used in the template are: text - the text the legend item.; series - the data series.; value - the point value. (only for donut and pie charts); percentage - the point value represented as a percentage value. Available only for 100% stacked charts. or dataItem - the original data item used to construct the point..
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\StockChartLegendInactiveItemsLabels
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

//<< Properties
}

?>
