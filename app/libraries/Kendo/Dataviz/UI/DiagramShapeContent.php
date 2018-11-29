<?php

namespace Kendo\Dataviz\UI;

class DiagramShapeContent extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The alignment of the text inside the shape. You can do combinations between "top", "middle" and "bottom" for vertical align and "right", "center" and "left" for horizontal align. For example, "top right", "middle left", "bottom center", and so on.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function align($value) {
        return $this->setProperty('align', $value);
    }

    /**
    * The color of the shape content text.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The font family of the shape content text.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function fontFamily($value) {
        return $this->setProperty('fontFamily', $value);
    }

    /**
    * The font size of the shape content text.
    * @param float $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function fontSize($value) {
        return $this->setProperty('fontSize', $value);
    }

    /**
    * The font style of the shape content text.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function fontStyle($value) {
        return $this->setProperty('fontStyle', $value);
    }

    /**
    * The font weight of the shape content text.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function fontWeight($value) {
        return $this->setProperty('fontWeight', $value);
    }

    /**
    * Sets the template option of the DiagramShapeContent.
    * The template which renders the labels.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the DiagramShapeContent.
    * The template which renders the labels.
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

    /**
    * The text displayed in the shape.
    * @param string $value
    * @return \Kendo\Dataviz\UI\DiagramShapeContent
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

//<< Properties
}

?>
