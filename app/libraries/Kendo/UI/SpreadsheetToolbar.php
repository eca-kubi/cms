<?php

namespace Kendo\UI;

class SpreadsheetToolbar extends \Kendo\SerializableObject {
//>> Properties

    /**
    * A boolean value indicating if the "home" tab should be displayed or a collection of tools that will be shown in the "home" tab.The available tools are: open; exportAs; [cut, copy, paste]; [bold, italic, underline]; backgroundColor, textColor; borders; fontSize, fontFamily; alignment; textWrap; [formatDecreaseDecimal, formatIncreaseDecimal]; format; merge; freeze or filter. Those tools which are part of a tool group are defined as array. For example ["bold", "italic", "underline"]
    * @param boolean|array $value
    * @return \Kendo\UI\SpreadsheetToolbar
    */
    public function home($value) {
        return $this->setProperty('home', $value);
    }

    /**
    * A boolean value indicating if the "insert" tab should be displayed or a collection of tools that will be shown in the "insert" tab.The available tools are: [ addColumnLeft, addColumnRight, addRowBelow, addRowAbove ] or [ deleteColumn, deleteRow ]. Those tools which are part of a tool group are defined as array. For example ["deleteColumn", "deleteRow"]
    * @param boolean|array $value
    * @return \Kendo\UI\SpreadsheetToolbar
    */
    public function insert($value) {
        return $this->setProperty('insert', $value);
    }

    /**
    * A boolean value indicating if the "insert" tab should be displayed or a collection of tools that will be shown in the "insert" tab.The available tools are: sort; filter or validation.
    * @param boolean|array $value
    * @return \Kendo\UI\SpreadsheetToolbar
    */
    public function data($value) {
        return $this->setProperty('data', $value);
    }

//<< Properties
}

?>
