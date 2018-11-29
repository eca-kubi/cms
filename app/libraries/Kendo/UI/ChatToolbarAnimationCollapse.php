<?php

namespace Kendo\UI;

class ChatToolbarAnimationCollapse extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Configures the effects of the toolbar collapse animation.
    * @param string $value
    * @return \Kendo\UI\ChatToolbarAnimationCollapse
    */
    public function effects($value) {
        return $this->setProperty('effects', $value);
    }

    /**
    * Configures the duration (in miliseconds) of the toolbar collapse animation.
    * @param float $value
    * @return \Kendo\UI\ChatToolbarAnimationCollapse
    */
    public function duration($value) {
        return $this->setProperty('duration', $value);
    }

//<< Properties
}

?>
