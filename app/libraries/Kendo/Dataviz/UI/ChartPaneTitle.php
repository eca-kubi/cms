<?php

namespace Kendo\Dataviz\UI;

class ChartPaneTitle extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The background color of the title. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function background($value) {
        return $this->setProperty('background', $value);
    }

    /**
    * The border of the title.
    * @param \Kendo\Dataviz\UI\ChartPaneTitleBorder|array $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The text color of the title. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The font style of the title.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function font($value) {
        return $this->setProperty('font', $value);
    }

    /**
    * The margin of the title. A numeric value will set all margins.
    * @param float|\Kendo\Dataviz\UI\ChartPaneTitleMargin|array $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function margin($value) {
        return $this->setProperty('margin', $value);
    }

    /**
    * The position of the title.The supported values are: "left" - the axis title is positioned on the left (applicable to horizontal axis); "right" - the axis title is positioned on the right (applicable to horizontal axis) or "center" - the axis title is positioned in the center.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * The text of the title.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

    /**
    * If set to true the chart will display the pane title. By default the pane title is visible.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

    /**
    * Sets the visual option of the ChartPaneTitle.
    * A function that can be used to create a custom visual for the title. The available argument fields are: text - the label text.; rect - the kendo.geometry.Rect that defines where the visual should be rendered.; sender - the chart instance (may be undefined).; options - the label options. or createVisual - a function that can be used to get the default visual..
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Dataviz\UI\ChartPaneTitle
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
