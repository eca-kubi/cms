<?php

namespace Kendo\UI;

class GridColumnSortable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * If set to true the user can get the grid in unsorted state by clicking the sorted column header. If set to false the user will not be able to unsort the column once sorted.
    * @param boolean $value
    * @return \Kendo\UI\GridColumnSortable
    */
    public function allowUnsort($value) {
        return $this->setProperty('allowUnsort', $value);
    }

    /**
    * Sets the compare option of the GridColumnSortable.
    * A JavaScript function which is used to compare the values. It has the same signature as the compare function accepted by Array.sort.The basic function implementation is as follows (pseudo-code): ```pseudo     function compare(a, b, descending) {       if (a is less than b by some ordering criterion) {         return -1;       }```One notable exception is that we also supply a third parameter that indicates the sort direction (true for descending). See How-to: Stable Sort in Chrome for more details on how this can be useful.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\GridColumnSortable
    */
    public function compare($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('compare', $value);
    }

    /**
    * Determines the inital (from un-sorted to sorted state) sort direction. The supported values are asc and desc.
    * @param string $value
    * @return \Kendo\UI\GridColumnSortable
    */
    public function initialDirection($value) {
        return $this->setProperty('initialDirection', $value);
    }

//<< Properties
}

?>
