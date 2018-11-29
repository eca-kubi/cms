<?php

namespace Kendo\UI;

class GridPageable extends \Kendo\SerializableObject {
//>> Properties

    /**
    * By default the grid will show the pager even when total amount of items in the DataSource is less than the pageSize.If set to false the grid will toggle the pager visibility as follows: when the total amount of items initially set in the DataSource is less than the pageSize number the pager will be hidden.; when the total amount of items initially set in the DataSource is greater than or equal to the pageSize number the pager will be shown.; when the total amount of items in the DataSource becomes less than the pageSize number (after delete, filter operation or pageSize change) the pager will be hidden. or when the total amount of items in the DataSource becomes greater than or equal to the pageSize number (after an insert, filter operation or pageSize change) the pager will be shown.. Introduced in the Kendo UI 2017 R3 release.
    * @param boolean $value
    * @return \Kendo\UI\GridPageable
    */
    public function alwaysVisible($value) {
        return $this->setProperty('alwaysVisible', $value);
    }

    /**
    * The number of data items which will be displayed in the grid. This setting will not work if the Grid is assigned an already existing Kendo UI DataSource instance.
    * @param float $value
    * @return \Kendo\UI\GridPageable
    */
    public function pageSize($value) {
        return $this->setProperty('pageSize', $value);
    }

    /**
    * If set to true the pager will display buttons for going to the first, previous, next and last pages. By default those buttons are displayed.
    * @param boolean $value
    * @return \Kendo\UI\GridPageable
    */
    public function previousNext($value) {
        return $this->setProperty('previousNext', $value);
    }

    /**
    * If set to true the pager will display buttons for navigating to specific pages. By default those buttons are displayed.Using pageable.numeric and pageable.input at the same time is not recommended.
    * @param boolean $value
    * @return \Kendo\UI\GridPageable
    */
    public function numeric($value) {
        return $this->setProperty('numeric', $value);
    }

    /**
    * The maximum number of buttons displayed in the numeric pager. The pager will display ellipsis (...) if there are more pages than the specified number.
    * @param float $value
    * @return \Kendo\UI\GridPageable
    */
    public function buttonCount($value) {
        return $this->setProperty('buttonCount', $value);
    }

    /**
    * If set to true the pager will display an input element which allows the user to type a specific page number. By default the page input is not displayed.Using pageable.input and pageable.numeric at the same time is not recommended.
    * @param boolean $value
    * @return \Kendo\UI\GridPageable
    */
    public function input($value) {
        return $this->setProperty('input', $value);
    }

    /**
    * If set to true the pager will display a drop-down which allows the user to pick a page size. By default the page size drop-down is not displayed.Can be set to an array of predefined page sizes to override the default list. A special all value is supported. It sets the page size to the total number of records.If a pageSize setting is provided for the data source then this value will be selected initially.
    * @param boolean|array $value
    * @return \Kendo\UI\GridPageable
    */
    public function pageSizes($value) {
        return $this->setProperty('pageSizes', $value);
    }

    /**
    * If set to true the pager will display the refresh button. Clicking the refresh button will refresh the grid. By default the refresh button is not displayed.
    * @param boolean $value
    * @return \Kendo\UI\GridPageable
    */
    public function refresh($value) {
        return $this->setProperty('refresh', $value);
    }

    /**
    * If set to true the pager will display information about the current page and total number of data items. By default the paging information is displayed.
    * @param boolean $value
    * @return \Kendo\UI\GridPageable
    */
    public function info($value) {
        return $this->setProperty('info', $value);
    }

    /**
    * The text messages displayed in pager. Use this option to customize or localize the pager messages.
    * @param \Kendo\UI\GridPageableMessages|array $value
    * @return \Kendo\UI\GridPageable
    */
    public function messages($value) {
        return $this->setProperty('messages', $value);
    }

//<< Properties
}

?>
