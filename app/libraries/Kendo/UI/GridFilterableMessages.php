<?php

namespace Kendo\UI;

class GridFilterableMessages extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The text of the option which represents the "and" logical operation.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function _and($value) {
        return $this->setProperty('and', $value);
    }

    /**
    * The text of the button which clears the filter.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function clear($value) {
        return $this->setProperty('clear', $value);
    }

    /**
    * The text of the button which applies the filter.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function filter($value) {
        return $this->setProperty('filter', $value);
    }

    /**
    * The text of the information message on the top of the filter menu.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function info($value) {
        return $this->setProperty('info', $value);
    }

    /**
    * The text rendered for the title attribute of the filter menu form.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function title($value) {
        return $this->setProperty('title', $value);
    }

    /**
    * The text of the radio button for false values. Displayed when filtering Boolean fields.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function isFalse($value) {
        return $this->setProperty('isFalse', $value);
    }

    /**
    * The text of the radio button for true values. Displayed when filtering Boolean fields.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function isTrue($value) {
        return $this->setProperty('isTrue', $value);
    }

    /**
    * The text of the option which represents the "or" logical operation.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function _or($value) {
        return $this->setProperty('or', $value);
    }

    /**
    * The placeholder of the search input for columns with the search option set to true.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function search($value) {
        return $this->setProperty('search', $value);
    }

    /**
    * The text of the DropDownList displayed in the filter menu for columns whose values option is set.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function selectValue($value) {
        return $this->setProperty('selectValue', $value);
    }

    /**
    * The text of the cancel button in the filter menu header (available in mobile mode only).
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function cancel($value) {
        return $this->setProperty('cancel', $value);
    }

    /**
    * The format string for selected items count in filter menu when search option set to true.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function selectedItemsFormat($value) {
        return $this->setProperty('selectedItemsFormat', $value);
    }

    /**
    * The text of the operator item in filter menu (available in mobile mode only).
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function operator($value) {
        return $this->setProperty('operator', $value);
    }

    /**
    * The text of the value item in filter menu (available in mobile mode only).
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function value($value) {
        return $this->setProperty('value', $value);
    }

    /**
    * The label used for the check-all checkbox.
    * @param string $value
    * @return \Kendo\UI\GridFilterableMessages
    */
    public function checkAll($value) {
        return $this->setProperty('checkAll', $value);
    }

//<< Properties
}

?>
