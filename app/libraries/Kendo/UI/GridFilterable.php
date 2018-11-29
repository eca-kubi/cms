<?php

namespace Kendo\UI;

class GridFilterable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * If set to true the filter menu allows the user to input a second criterion.
    * @param boolean $value
    * @return \Kendo\UI\GridFilterable
    */
    public function extra($value) {
        return $this->setProperty('extra', $value);
    }

    /**
    * The text messages displayed in the filter menu. Use it to customize or localize the filter menu messages.
    * @param \Kendo\UI\GridFilterableMessages|array $value
    * @return \Kendo\UI\GridFilterable
    */
    public function messages($value) {
        return $this->setProperty('messages', $value);
    }

    /**
    * If set to row the user would be able to filter via extra row added below the headers. By default filtering is using the menu mode.Can also be set to the following string values: "row" - the user can filter via extra row within the header.; "menu" - the user can filter via the menu after clicking the filter icon. or "menu, row" - the user can filter with both modes above enabled..
    * @param string $value
    * @return \Kendo\UI\GridFilterable
    */
    public function mode($value) {
        return $this->setProperty('mode', $value);
    }

    /**
    * The text of the filter operators displayed in the filter menu.
    * @param \Kendo\UI\GridFilterableOperators|array $value
    * @return \Kendo\UI\GridFilterable
    */
    public function operators($value) {
        return $this->setProperty('operators', $value);
    }

//<< Properties
}

?>
