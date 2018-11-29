<?php

namespace Kendo\Dataviz\UI;

class ChartSeriesItemLabelsTo extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The background color of the to labels. Accepts a valid CSS color string, including hex and rgb.
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function background($value) {
        return $this->setProperty('background', $value);
    }

    /**
    * The border of the to labels.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemLabelsToBorder|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The text color of the to labels. Accepts a valid CSS color string, including hex and rgb.
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The font style of the to labels.
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function font($value) {
        return $this->setProperty('font', $value);
    }

    /**
    * The format of the to labels. Uses kendo.format.
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function format($value) {
        return $this->setProperty('format', $value);
    }

    /**
    * The margin of the to labels. A numeric value will set all margins.
    * @param float|\Kendo\Dataviz\UI\ChartSeriesItemLabelsToMargin|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function margin($value) {
        return $this->setProperty('margin', $value);
    }

    /**
    * The padding of the to labels. A numeric value will set all paddings.
    * @param float|\Kendo\Dataviz\UI\ChartSeriesItemLabelsToPadding|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function padding($value) {
        return $this->setProperty('padding', $value);
    }

    /**
    * The position of the to labels. "center" - the label is positioned at the point center.; "insideBase" - the label is positioned inside, near the base of the bar.; "insideEnd" - the label is positioned inside, near the end of the point.; "outsideEnd" - the label is positioned outside, near the end of the point.; "above" - the label is positioned at the top of the marker. Applicable for "rangeArea" and "verticalRangeArea" series.; "below" - the label is positioned at the bottom of the marker. Applicable for "rangeArea" and "verticalRangeArea" series.; "left" - the label is positioned to the left of the marker. Applicable for "rangeArea" and "verticalRangeArea" series. or "right" - the label is positioned to the right of the marker. Applicable for "rangeArea" and "verticalRangeArea" series..
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * Sets the template option of the ChartSeriesItemLabelsTo.
    * The template which renders the chart series to label.The fields which can be used in the template are: category - the category name.; dataItem - the original data item used to construct the point. Will be null if binding to array.; series - the data series or value - the point value. An object containing from and to values..
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the ChartSeriesItemLabelsTo.
    * The template which renders the chart series to label.The fields which can be used in the template are: category - the category name.; dataItem - the original data item used to construct the point. Will be null if binding to array.; series - the data series or value - the point value. An object containing from and to values..
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

    /**
    * If set to true the chart will display the series to labels. By default chart series to labels are not displayed.
    * @param boolean|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItemLabelsTo
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

//<< Properties
}

?>
