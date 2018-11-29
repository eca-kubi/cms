<?php

namespace Kendo\UI;

class Chat extends \Kendo\UI\Widget {
    public function name() {
        return 'Chat';
    }
//>> Properties

    /**
    * Allows localization of the strings that are used in the widget.
    * @param \Kendo\UI\ChatMessages|array $value
    * @return \Kendo\UI\Chat
    */
    public function messages($value) {
        return $this->setProperty('messages', $value);
    }

    /**
    * Configures the Kendo UI Chat user information.
    * @param \Kendo\UI\ChatUser|array $value
    * @return \Kendo\UI\Chat
    */
    public function user($value) {
        return $this->setProperty('user', $value);
    }

    /**
    * Configures the Kendo UI Chat toolbar.
    * @param \Kendo\UI\ChatToolbar|array $value
    * @return \Kendo\UI\Chat
    */
    public function toolbar($value) {
        return $this->setProperty('toolbar', $value);
    }

    /**
    * Sets the actionClick event of the Chat.
    * Fired when an action button is clicked inside an attachment template, or when a suggestedAction is clicked.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Chat
    */
    public function actionClick($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('actionClick', $value);
    }

    /**
    * Sets the post event of the Chat.
    * Fired when a message is posted to the chat widget. This can be either through the message box, or an action button click.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Chat
    */
    public function post($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('post', $value);
    }

    /**
    * Sets the sendMessage event of the Chat.
    * Fired when a message is posted through the chat message box.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Chat
    */
    public function sendMessage($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('sendMessage', $value);
    }

    /**
    * Sets the typingEnd event of the Chat.
    * Fired when the user clears the chat message box, signaling that he stopped typing. The event is also triggered when the user submits the currenlty typed in message.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Chat
    */
    public function typingEnd($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('typingEnd', $value);
    }

    /**
    * Sets the typingStart event of the Chat.
    * Fired when the user starts typing in the chat message box. The event is fired only once, and not upon each keystroke.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Chat
    */
    public function typingStart($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('typingStart', $value);
    }

    /**
    * Sets the toolClick event of the Chat.
    * Fired when a button from the toolbar is clicked.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Chat
    */
    public function toolClick($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('toolClick', $value);
    }


//<< Properties
}

?>
