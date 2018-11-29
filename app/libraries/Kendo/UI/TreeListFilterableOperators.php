<?php

namespace Kendo\UI;

class TreeListFilterableOperators extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The texts of the filter operators displayed for columns bound to string fields.
    * @param \Kendo\UI\TreeListFilterableOperatorsString|array $value
    * @return \Kendo\UI\TreeListFilterableOperators
    */
    public function string($value) {
        return $this->setProperty('string', $value);
    }

    /**
    * The texts of the filter operators displayed for columns bound to number fields.
    * @param \Kendo\UI\TreeListFilterableOperatorsNumber|array $value
    * @return \Kendo\UI\TreeListFilterableOperators
    */
    public function number($value) {
        return $this->setProperty('number', $value);
    }

    /**
    * The texts of the filter operators displayed for columns bound to date fields.
    * @param \Kendo\UI\TreeListFilterableOperatorsDate|array $value
    * @return \Kendo\UI\TreeListFilterableOperators
    */
    public function date($value) {
        return $this->setProperty('date', $value);
    }

//<< Properties
}

?>
