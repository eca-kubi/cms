<?php

namespace Kendo\UI;

class ChatMessages extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The hint displayed in the input textbox of the widget.
    * @param string $value
    * @return \Kendo\UI\ChatMessages
    */
    public function placeholder($value) {
        return $this->setProperty('placeholder', $value);
    }

//<< Properties
}

?>
