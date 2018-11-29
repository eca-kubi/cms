<?php

namespace Kendo\Dataviz\UI;

class DiagramEditable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Sets the connectionTemplate option of the DiagramEditable.
    * Specifies the connection editor template which shows up when editing the connection. A template can be used to change the default editors for the connection fields or to prevent some fields from being edited by not rendering an editor input for them.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function connectionTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('connectionTemplate', $value);
    }

    /**
    * Sets the connectionTemplate option of the DiagramEditable.
    * Specifies the connection editor template which shows up when editing the connection. A template can be used to change the default editors for the connection fields or to prevent some fields from being edited by not rendering an editor input for them.
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function connectionTemplate($value) {
        return $this->setProperty('connectionTemplate', $value);
    }

    /**
    * Specifies if the shapes and connections can be dragged.
    * @param boolean|\Kendo\Dataviz\UI\DiagramEditableDrag|array $value
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function drag($value) {
        return $this->setProperty('drag', $value);
    }

    /**
    * Specifies if the shapes and connections can be removed.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function remove($value) {
        return $this->setProperty('remove', $value);
    }

    /**
    * Defines the look-and-feel of the shape resizing handles.
    * @param boolean|\Kendo\Dataviz\UI\DiagramEditableResize|array $value
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function resize($value) {
        return $this->setProperty('resize', $value);
    }

    /**
    * Specifies whether the shapes can be rotated. Note that changing this setting after creating the diagram will have no effect.
    * @param boolean|\Kendo\Dataviz\UI\DiagramEditableRotate|array $value
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function rotate($value) {
        return $this->setProperty('rotate', $value);
    }

    /**
    * Sets the shapeTemplate option of the DiagramEditable.
    * Specifies the shape editor template. You can use it to customize the editing UI of the shape or to display editor controls only for certain fields of the shape data item.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function shapeTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('shapeTemplate', $value);
    }

    /**
    * Sets the shapeTemplate option of the DiagramEditable.
    * Specifies the shape editor template. You can use it to customize the editing UI of the shape or to display editor controls only for certain fields of the shape data item.
    * @param string $value The template content.
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function shapeTemplate($value) {
        return $this->setProperty('shapeTemplate', $value);
    }

    /**
    * Adds DiagramEditableTool to the DiagramEditable.
    * @param \Kendo\Dataviz\UI\DiagramEditableTool|array,... $value one or more DiagramEditableTool to add.
    * @return \Kendo\Dataviz\UI\DiagramEditable
    */
    public function addTool($value) {
        return $this->add('tools', func_get_args());
    }

//<< Properties
}

?>
