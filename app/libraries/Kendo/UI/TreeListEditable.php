<?php

namespace Kendo\UI;

class TreeListEditable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Enables drag&drop UI of rows between parents.
    * @param boolean $value
    * @return \Kendo\UI\TreeListEditable
    */
    public function move($value) {
        return $this->setProperty('move', $value);
    }

    /**
    * Sets the template option of the TreeListEditable.
    * The template which renders the popup editor.The template should contain elements which name HTML attribute is set to the name of the editable field. This is how the TreeList will know which field to bind each editor to. The other option is to use MVVM bindings in order to bind HTML elements to data item fields.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\TreeListEditable
    */
    public function templateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('template', $value);
    }

    /**
    * Sets the template option of the TreeListEditable.
    * The template which renders the popup editor.The template should contain elements which name HTML attribute is set to the name of the editable field. This is how the TreeList will know which field to bind each editor to. The other option is to use MVVM bindings in order to bind HTML elements to data item fields.
    * @param string $value The template content.
    * @return \Kendo\UI\TreeListEditable
    */
    public function template($value) {
        return $this->setProperty('template', $value);
    }

    /**
    * Configures the Kendo UI Window instance, which is used when the TreeList edit mode is "popup".For more information, please refer to the Window configuration API.
    * @param  $value
    * @return \Kendo\UI\TreeListEditable
    */
    public function window($value) {
        return $this->setProperty('window', $value);
    }

    /**
    * The editing mode to use. The supported editing modes are "inline", "popup" and "incell".
    * @param string $value
    * @return \Kendo\UI\TreeListEditable
    */
    public function mode($value) {
        return $this->setProperty('mode', $value);
    }

//<< Properties
}

?>
