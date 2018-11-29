<?php

namespace Kendo\UI;

class ChatUser extends \Kendo\SerializableObject {
//>> Properties

    /**
    * If set, sets the image url to be used for the user avatar icon.
    * @param string $value
    * @return \Kendo\UI\ChatUser
    */
    public function iconUrl($value) {
        return $this->setProperty('iconUrl', $value);
    }

    /**
    * Sets the name of the chat user.
    * @param string $value
    * @return \Kendo\UI\ChatUser
    */
    public function name($value) {
        return $this->setProperty('name', $value);
    }

//<< Properties
}

?>
