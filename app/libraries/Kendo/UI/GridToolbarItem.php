<?php

namespace Kendo\UI;

class GridToolbarItem extends \Kendo\SerializableObject {
    function __construct($name = null) {
        $this->name($name);
    }
//>> Properties

    /**
    * The class for the web font icon of the button that will be rendered in the toolbar.
    * @param string $value
    * @return \Kendo\UI\GridToolbarItem
    */
    public function iconClass($value) {
        return $this->setProperty('iconClass', $value);
    }

    /**
    * The name of the toolbar command. Either a built-in ("cancel", "create", "save", "excel", "pdf") or custom. The name is reflected in one of the CSS classes, which is applied to the button - k-grid-name. This class can be used to obtain reference to the button after Grid initialization and attach click handlers.
    * @param string $value
    * @return \Kendo\UI\GridToolbarItem
    */
    public function name($value) {
        return $this->setProperty('name', $value);
    }

    /**
    * Sets the template option of the GridToolbarItem.
    * The template which renders the command. By default renders a button.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\GridToolbarItem
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the GridToolbarItem.
    * The template which renders the command. By default renders a button.
    * @param string $value The template content.
    * @return \Kendo\UI\GridToolbarItem
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

    /**
    * The text displayed by the command button. If not set the name` option would be used as the button text instead.
    * @param string $value
    * @return \Kendo\UI\GridToolbarItem
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

//<< Properties
}

?>
