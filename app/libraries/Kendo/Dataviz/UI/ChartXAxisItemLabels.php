<?php

namespace Kendo\Dataviz\UI;

class ChartXAxisItemLabels extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The background color of the labels. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function background($value) {
        return $this->setProperty('background', $value);
    }

    /**
    * The border of the labels.
    * @param \Kendo\Dataviz\UI\ChartXAxisItemLabelsBorder|array $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The text color of the labels. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The culture to use when formatting date values. See the globalization overview for more information.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function culture($value) {
        return $this->setProperty('culture', $value);
    }

    /**
    * The format used to display the labels when the x values are dates. Uses kendo.format. Contains one placeholder ("{0}") which represents the category value.
    * @param \Kendo\Dataviz\UI\ChartXAxisItemLabelsDateFormats|array $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function dateFormats($value) {
        return $this->setProperty('dateFormats', $value);
    }

    /**
    * The font style of the labels.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function font($value) {
        return $this->setProperty('font', $value);
    }

    /**
    * The format used to display the labels. Uses kendo.format. Contains one placeholder ("{0}") which represents the category value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function format($value) {
        return $this->setProperty('format', $value);
    }

    /**
    * The margin of the labels. A numeric value will set all margins.
    * @param float|\Kendo\Dataviz\UI\ChartXAxisItemLabelsMargin|array $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function margin($value) {
        return $this->setProperty('margin', $value);
    }

    /**
    * If set to true the chart will mirror the axis labels and ticks. If the labels are normally on the left side of the axis, mirroring the axis will render them to the right.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function mirror($value) {
        return $this->setProperty('mirror', $value);
    }

    /**
    * The padding of the labels. A numeric value will set all paddings.
    * @param float|\Kendo\Dataviz\UI\ChartXAxisItemLabelsPadding|array $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function padding($value) {
        return $this->setProperty('padding', $value);
    }

    /**
    * The position of the axis labels. By default, labels are positioned next to the axis. When position is set to end, the labels are placed at the end of the crossing axis— typically, at the top or right end of the Chart unless the crossing axis was reversed. or When position is set to start, the labels are placed at the start of the crossing axis— typically, at the left or bottom end of the Chart unless the crossing axis was reversed..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * The rotation angle of the labels. By default the labels are not rotated. Can be set to "auto" in which case the labels will be rotated only if the slot size is not sufficient for the entire labels.
    * @param float|string|\Kendo\Dataviz\UI\ChartXAxisItemLabelsRotation|array $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function rotation($value) {
        return $this->setProperty('rotation', $value);
    }

    /**
    * The number of labels to skip.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function skip($value) {
        return $this->setProperty('skip', $value);
    }

    /**
    * The label rendering step - render every n-th label. By default every label is rendered.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function step($value) {
        return $this->setProperty('step', $value);
    }

    /**
    * Sets the template option of the ChartXAxisItemLabels.
    * The template which renders the labels.The fields which can be used in the template are: value - the category value.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the ChartXAxisItemLabels.
    * The template which renders the labels.The fields which can be used in the template are: value - the category value.
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

    /**
    * If set to true the chart will display the x axis labels. By default the x axis labels are visible.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

    /**
    * Sets the visual option of the ChartXAxisItemLabels.
    * A function that can be used to create a custom visual for the labels. The available argument fields are: createVisual - a function that can be used to get the default visual.; culture - the default culture (if set) on the label; format - the default format of the label; options - the label options.; rect - the kendo.geometry.Rect that defines where the visual should be rendered.; sender - the chart instance (may be undefined).; text - the label text. or value - the category value.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Dataviz\UI\ChartXAxisItemLabels
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
