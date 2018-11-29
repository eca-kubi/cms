<?php

namespace Kendo\Dataviz\UI;

class MapLayerTooltip extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Specifies if the tooltip will be hidden when mouse leaves the target element. If set to false a close button will be shown within tooltip. If set to false, showAfter is specified and the showOn is set to "mouseenter" the Tooltip will be displayed after the given timeout even if the element is no longer hovered.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function autoHide($value) {
        return $this->setProperty('autoHide', $value);
    }

    /**
    * A collection of {Animation} objects, used to change default animations. A value of false will disable all animations in the widget.
    * @param \Kendo\Dataviz\UI\MapLayerTooltipAnimation|array $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function animation($value) {
        return $this->setProperty('animation', $value);
    }

    /**
    * The text or a function which result will be shown within the tooltip. By default the tooltip will display the target element title attribute content.
    * @param string|\Kendo\JavaScriptFunction|\Kendo\Dataviz\UI\MapLayerTooltipContent|array $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function content($value) {
        return $this->setProperty('content', $value);
    }

    /**
    * Sets the template option of the MapLayerTooltip.
    * The template which renders the tooltip content.The fields which can be used in the template are: location - the marker location (kendo.dataviz.map.Location instance) or marker - the marker instance.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the MapLayerTooltip.
    * The template which renders the tooltip content.The fields which can be used in the template are: location - the marker location (kendo.dataviz.map.Location instance) or marker - the marker instance.
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

    /**
    * Specifies if the tooltip callout will be displayed.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function callout($value) {
        return $this->setProperty('callout', $value);
    }

    /**
    * Explicitly states whether content iframe should be created.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function iframe($value) {
        return $this->setProperty('iframe', $value);
    }

    /**
    * The height (in pixels) of the tooltip.
    * @param float $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function height($value) {
        return $this->setProperty('height', $value);
    }

    /**
    * The width (in pixels) of the tooltip.
    * @param float $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function width($value) {
        return $this->setProperty('width', $value);
    }

    /**
    * The position relative to the target element, at which the tooltip will be shown. Predefined values are "bottom", "top", "left", "right", "center".
    * @param string $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * Specify the delay in milliseconds before the tooltip is shown. This option is ignored if showOn is set to "click" or "focus".
    * @param float $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function showAfter($value) {
        return $this->setProperty('showAfter', $value);
    }

    /**
    * The event on which the tooltip will be shown. Predefined values are "mouseenter", "click" and "focus".
    * @param string $value
    * @return \Kendo\Dataviz\UI\MapLayerTooltip
    */
    public function showOn($value) {
        return $this->setProperty('showOn', $value);
    }

//<< Properties
}

?>
