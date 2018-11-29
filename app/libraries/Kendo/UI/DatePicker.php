<?php

namespace Kendo\UI;

class DatePicker extends \Kendo\UI\Widget {
    protected function name() {
        return 'DatePicker';
    }

    protected function createElement() {
        return new \Kendo\Html\Element('input', true);
    }
	
	/**
    * An array or function that will be used to determine which dates to be disabled in the widget.
    * @param array|\Kendo\JavaScriptFunction $value
    * @return \Kendo\UI\DatePicker
    */
    public function disableDates($value) {
		if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }
        return $this->setProperty('disableDates', $value);
    }
//>> Properties

    /**
    * Configures the opening and closing animations of the calendar popup. Setting the animation option to false will disable the opening and closing animations. As a result the calendar popup will open and close instantly. is not a valid configuration.
    * @param boolean|\Kendo\UI\DatePickerAnimation|array $value
    * @return \Kendo\UI\DatePicker
    */
    public function animation($value) {
        return $this->setProperty('animation', $value);
    }

    /**
    * Sets the ARIATemplate option of the DatePicker.
    * Specifies a template used to populate value of the aria-label attribute.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\DatePicker
    */
    public function ARIATemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('ARIATemplate', $value);
    }

    /**
    * Sets the ARIATemplate option of the DatePicker.
    * Specifies a template used to populate value of the aria-label attribute.
    * @param string $value The template content.
    * @return \Kendo\UI\DatePicker
    */
    public function ARIATemplate($value) {
        return $this->setProperty('ARIATemplate', $value);
    }

    /**
    * Specifies the culture info used by the widget.
    * @param string $value
    * @return \Kendo\UI\DatePicker
    */
    public function culture($value) {
        return $this->setProperty('culture', $value);
    }

    /**
    * Specifies if the DatePicker will use DateInput for editing value
    * @param boolean $value
    * @return \Kendo\UI\DatePicker
    */
    public function dateInput($value) {
        return $this->setProperty('dateInput', $value);
    }

    /**
    * Specifies a list of dates, which will be passed to the month template.
    * @param array $value
    * @return \Kendo\UI\DatePicker
    */
    public function dates($value) {
        return $this->setProperty('dates', $value);
    }

    /**
    * Specifies the navigation depth. The following settings are available for the depth value: "month" - Shows the days of the month.; "year" - Shows the months of the year.; "decade" - Shows the years of the decade. or "century" - Shows the decades from the century..
    * @param string $value
    * @return \Kendo\UI\DatePicker
    */
    public function depth($value) {
        return $this->setProperty('depth', $value);
    }

    /**
    * The template which renders the footer of the calendar. If false, the footer will not be rendered.
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\UI\DatePicker
    */
    public function footer($value) {
        return $this->setProperty('footer', $value);
    }

    /**
    * Specifies the format, which is used to format the value of the DatePicker displayed in the input. The format also will be used to parse the input.For more information on date and time formats please refer to Date Formatting.
    * @param string $value
    * @return \Kendo\UI\DatePicker
    */
    public function format($value) {
        return $this->setProperty('format', $value);
    }

    /**
    * Specifies the maximum date, which the calendar can show.
    * @param date $value
    * @return \Kendo\UI\DatePicker
    */
    public function max($value) {
        return $this->setProperty('max', $value);
    }

    /**
    * Specifies the minimum date that the calendar can show.
    * @param date $value
    * @return \Kendo\UI\DatePicker
    */
    public function min($value) {
        return $this->setProperty('min', $value);
    }

    /**
    * Templates for the cells rendered in the calendar "month" view.
    * @param \Kendo\UI\DatePickerMonth|array $value
    * @return \Kendo\UI\DatePicker
    */
    public function month($value) {
        return $this->setProperty('month', $value);
    }

    /**
    * If set to true a week of the year will be shown on the left side of the calendar. It is possible to define a template in order to customize what will be displayed.
    * @param boolean $value
    * @return \Kendo\UI\DatePicker
    */
    public function weekNumber($value) {
        return $this->setProperty('weekNumber', $value);
    }

    /**
    * Specifies a list of date formats used to parse the value set with value() method or by direct user input. If not set the value of the format will be used.  Note that the format option is always used during parsing.
    * @param array $value
    * @return \Kendo\UI\DatePicker
    */
    public function parseFormats($value) {
        return $this->setProperty('parseFormats', $value);
    }

    /**
    * Specifies the start view. The following settings are available for the start value: "month" - Shows the days of the month.; "year" - Shows the months of the year.; "decade" - Shows the years of the decade. or "century" - Shows the decades from the century..
    * @param string $value
    * @return \Kendo\UI\DatePicker
    */
    public function start($value) {
        return $this->setProperty('start', $value);
    }

    /**
    * Specifies the selected date.
    * @param date $value
    * @return \Kendo\UI\DatePicker
    */
    public function value($value) {
        return $this->setProperty('value', $value);
    }

    /**
    * Sets the change event of the DatePicker.
    * Fires when the selected date is changed
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\DatePicker
    */
    public function change($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('change', $value);
    }

    /**
    * Sets the close event of the DatePicker.
    * Fires when the calendar is closed
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\DatePicker
    */
    public function close($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('close', $value);
    }

    /**
    * Sets the open event of the DatePicker.
    * Fires when the calendar is opened
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\DatePicker
    */
    public function open($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('open', $value);
    }


//<< Properties
}

?>
