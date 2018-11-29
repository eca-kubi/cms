<?php

namespace Kendo\Dataviz\UI;

class ChartValueAxisItemNotes extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The position of the value axis note. "top" - The note is positioned on the top.; "bottom" - The note is positioned on the bottom.; "left" - The note is positioned on the left. or "right" - The note is positioned on the right..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartValueAxisItemNotes
    */
    public function position($value) {
        return $this->setProperty('position', $value);
    }

    /**
    * The icon of the notes.
    * @param \Kendo\Dataviz\UI\ChartValueAxisItemNotesIcon|array $value
    * @return \Kendo\Dataviz\UI\ChartValueAxisItemNotes
    */
    public function icon($value) {
        return $this->setProperty('icon', $value);
    }

    /**
    * The label of the notes.
    * @param \Kendo\Dataviz\UI\ChartValueAxisItemNotesLabel|array $value
    * @return \Kendo\Dataviz\UI\ChartValueAxisItemNotes
    */
    public function label($value) {
        return $this->setProperty('label', $value);
    }

    /**
    * The line of the notes.
    * @param \Kendo\Dataviz\UI\ChartValueAxisItemNotesLine|array $value
    * @return \Kendo\Dataviz\UI\ChartValueAxisItemNotes
    */
    public function line($value) {
        return $this->setProperty('line', $value);
    }

    /**
    * Adds ChartValueAxisItemNotesDataItem to the ChartValueAxisItemNotes.
    * @param \Kendo\Dataviz\UI\ChartValueAxisItemNotesDataItem|array,... $value one or more ChartValueAxisItemNotesDataItem to add.
    * @return \Kendo\Dataviz\UI\ChartValueAxisItemNotes
    */
    public function addDataItem($value) {
        return $this->add('data', func_get_args());
    }

    /**
    * Sets the visual option of the ChartValueAxisItemNotes.
    * A function that can be used to create a custom visual for the notes. The available argument fields are: rect - the kendo.geometry.Rect that defines the note target rect.; options - the note options.; createVisual - a function that can be used to get the default visual. or value - the note value..
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Dataviz\UI\ChartValueAxisItemNotes
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
