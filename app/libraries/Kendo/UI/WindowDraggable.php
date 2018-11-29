<?php

namespace Kendo\UI;

class WindowDraggable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Defines the element in which the window will be able to move. The window is appended to this element, thus, overriding the appendTo setting. Accepts either selector or an element.Note that the containment element should be positioned. In other words, it should have CSS position attribute of relative, absolute, or fixed.
    * @param string| $value
    * @return \Kendo\UI\WindowDraggable
    */
    public function containment($value) {
        return $this->setProperty('containment', $value);
    }

    /**
    * Constrains the dragging to horizontal (x) or vertical (y) axis. Accepts two possible values: "x", "y".
    * @param string $value
    * @return \Kendo\UI\WindowDraggable
    */
    public function axis($value) {
        return $this->setProperty('axis', $value);
    }

    /**
    * Restricts dragging of the window through the specified element which should be part of the window's content. Accepts either selector or element.
    * @param string $value
    * @return \Kendo\UI\WindowDraggable
    */
    public function dragHandle($value) {
        return $this->setProperty('dragHandle', $value);
    }

//<< Properties
}

?>
