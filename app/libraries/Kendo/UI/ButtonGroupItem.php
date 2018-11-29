<?php

namespace Kendo\UI;

class ButtonGroupItem extends \Kendo\SerializableObject {
    public function createElement() {
        $element = new \Kendo\Html\Element('span');
        $text = $this->getProperty('text');
        $iconClass = $this->getProperty('iconClass');
        $icon = $this->getProperty('icon');
        $encoded = $this->getProperty('encoded') !== false;
        $content = $this->getProperty('content');
        $badge = $this->getProperty('badge');
        $class = "";

        if ($this->getProperty('selected')) {
            $class = "k-state-active";
        }

        if ($this->getProperty('enabled') === false) {
            $element->attr('disabled', 'disabled');
        }

        if ($iconClass) {
            $iconElement = new \Kendo\Html\Element('span');
            $iconElement->attr('class', 'k-icon ' . $iconClass);
            $element->append($iconElement);
        } else if ($icon) {
            $element->attr("data-icon", $icon);
        }

        if ($iconClass || $icon) {
            $class = $class . $text ? " k-button-icontext" : " k-button-icon";
        }

        $element->append(new \Kendo\Html\Text($encoded ? htmlentities($text) : $text));

        if ($content) {
            $element->html($content);
        }

        if ($badge) {
            $element->attr("data-badge", $badge);
        }

        $element->attr('class', $class);

        return $element;
    }

//>> Properties

    /**
    * Specifies the HTML attributes of a ButtonGroup item.
    * @param  $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function attributes($value) {
        return $this->setProperty('attributes', $value);
    }

    /**
    * Specifies the badge of a button.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function badge($value) {
        return $this->setProperty('badge', $value);
    }

    /**
    * Specifies if a button is enabled.
    * @param boolean $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function enabled($value) {
        return $this->setProperty('enabled', $value);
    }

    /**
    * Defines the name of an existing icon in a Kendo theme.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function icon($value) {
        return $this->setProperty('icon', $value);
    }

    /**
    * Allows the usage of custom icons. Defines CSS classes which are to be applied to a span element inside the ButtonGroup item.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function iconClass($value) {
        return $this->setProperty('iconClass', $value);
    }

    /**
    * If set, the ButtonGroup will render an image with the specified URL in the button.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function imageUrl($value) {
        return $this->setProperty('imageUrl', $value);
    }

    /**
    * Specifies if a button is initially selected.
    * @param boolean $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function selected($value) {
        return $this->setProperty('selected', $value);
    }

    /**
    * Specifies the text of the ButtonGroup item.
    * @param string $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

    /**
    * Specifies if text field of the ButtonGroup item should be encoded.
    * @param boolean $value
    * @return \Kendo\UI\ButtonGroupItem
    */
    public function encoded($value) {
        return $this->setProperty('encoded', $value);
    }

//<< Properties
}

?>
