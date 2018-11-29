<?php

namespace Kendo\Dataviz\UI;

class ChartCategoryAxisItemNotes extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The position of the category axis note. "top" - The note is positioned on the top.; "bottom" - The note is positioned on the bottom.; "left" - The note is positioned on the left. or "right" - The note is positioned on the right..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartCategoryAxisItemNotes
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * The icon of the notes.
    * @param \Kendo\Dataviz\UI\ChartCategoryAxisItemNotesIcon|array $value
    * @return \Kendo\Dataviz\UI\ChartCategoryAxisItemNotes
    */
    public function icon($value) {
        return $this->setProperty('icon', $value);
    }

    /**
    * The label of the notes.
    * @param \Kendo\Dataviz\UI\ChartCategoryAxisItemNotesLabel|array $value
    * @return \Kendo\Dataviz\UI\ChartCategoryAxisItemNotes
    */
    public function label($value) {
        return $this->setProperty('label', $value);
    }

    /**
    * The line of the notes.
    * @param \Kendo\Dataviz\UI\ChartCategoryAxisItemNotesLine|array $value
    * @return \Kendo\Dataviz\UI\ChartCategoryAxisItemNotes
    */
    public function line($value) {
        return $this->setProperty('line', $value);
    }

    /**
    * Adds ChartCategoryAxisItemNotesDataItem to the ChartCategoryAxisItemNotes.
    * @param \Kendo\Dataviz\UI\ChartCategoryAxisItemNotesDataItem|array,... $value one or more ChartCategoryAxisItemNotesDataItem to add.
    * @return \Kendo\Dataviz\UI\ChartCategoryAxisItemNotes
    */
    public function addDataItem($value) {
        return $this->add('data', func_get_args());
    }

    /**
    * Sets the visual option of the ChartCategoryAxisItemNotes.
    * A function that can be used to create a custom visual for the notes. The available argument fields are: rect - the kendo.geometry.Rect that defines the note target rect.; options - the note options.; createVisual - a function that can be used to get the default visual. or value - the note value..
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Dataviz\UI\ChartCategoryAxisItemNotes
    */
    public function visual($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('visual', $value);
    }

//<< Properties
}

?>
