<?php

namespace Kendo\UI;

class SchedulerMessages extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The text similar to "all day" displayed in day,week and agenda views.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function allDay($value) {
        return $this->setProperty('allDay', $value);
    }

    /**
    * Specifies the format string used to populate the aria-label attribute value of the selected event element.The arguments which can be used in the format string are: {0} - represents the title of the selected event.; {1} - represents the start date of the event. or {2} - represents the start time of the event..
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function ariaEventLabel($value) {
        return $this->setProperty('ariaEventLabel', $value);
    }

    /**
    * Specifies the format string used to populate the aria-label attribute value of the selected slot element.The arguments which can be used in the format string are: {0} - represents the start date of the slot. or {1} - represents the end date of the slot..
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function ariaSlotLabel($value) {
        return $this->setProperty('ariaSlotLabel', $value);
    }

    /**
    * The text similar to "Cancel" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function cancel($value) {
        return $this->setProperty('cancel', $value);
    }

    /**
    * The text similar to "Date" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function date($value) {
        return $this->setProperty('date', $value);
    }

    /**
    * The text similar to "Delete event" displayed as title of the scheduler delete event window.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function deleteWindowTitle($value) {
        return $this->setProperty('deleteWindowTitle', $value);
    }

    /**
    * The text similar to "Delete" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function destroy($value) {
        return $this->setProperty('destroy', $value);
    }

    /**
    * The text similar to "Event" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function event($value) {
        return $this->setProperty('event', $value);
    }

    /**
    * The text similar to "All events" displayed in timeline views when there is no vertical grouping.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function defaultRowText($value) {
        return $this->setProperty('defaultRowText', $value);
    }

    /**
    * The tooltip of the next navigation button.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function next($value) {
        return $this->setProperty('next', $value);
    }

    /**
    * The text displayed by the PDF export button.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function pdf($value) {
        return $this->setProperty('pdf', $value);
    }

    /**
    * The tooltip of the previous navigation button.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function previous($value) {
        return $this->setProperty('previous', $value);
    }

    /**
    * The text similar to "Save" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function save($value) {
        return $this->setProperty('save', $value);
    }

    /**
    * The text similar to "Show full day" used in scheduler "showFullDay" button.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function showFullDay($value) {
        return $this->setProperty('showFullDay', $value);
    }

    /**
    * The text similar to "Show business hours" used in scheduler "showWorkDay" button.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function showWorkDay($value) {
        return $this->setProperty('showWorkDay', $value);
    }

    /**
    * The text similar to "Time" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function time($value) {
        return $this->setProperty('time', $value);
    }

    /**
    * The text similar to "Today" displayed in scheduler.
    * @param string $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function today($value) {
        return $this->setProperty('today', $value);
    }

    /**
    * The configuration of the scheduler editable messages. Use this option to customize or localize the scheduler editable messages.
    * @param \Kendo\UI\SchedulerMessagesEditable|array $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function editable($value) {
        return $this->setProperty('editable', $value);
    }

    /**
    * The configuration of the scheduler editor messages. Use this option to customize or localize the scheduler editor messages.
    * @param \Kendo\UI\SchedulerMessagesEditor|array $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function editor($value) {
        return $this->setProperty('editor', $value);
    }

    /**
    * The configuration of the scheduler recurrence editor messages. Use this option to customize or localize the scheduler recurrence editor messages.
    * @param \Kendo\UI\SchedulerMessagesRecurrenceEditor|array $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function recurrenceEditor($value) {
        return $this->setProperty('recurrenceEditor', $value);
    }

    /**
    * The configuration of the scheduler recurrence messages. Use this option to customize or localize the scheduler recurrence messages.
    * @param \Kendo\UI\SchedulerMessagesRecurrenceMessages|array $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function recurrenceMessages($value) {
        return $this->setProperty('recurrenceMessages', $value);
    }

    /**
    * The configuration of the scheduler views messages. Use this option to customize or localize the scheduler views messages.
    * @param \Kendo\UI\SchedulerMessagesViews|array $value
    * @return \Kendo\UI\SchedulerMessages
    */
    public function views($value) {
        return $this->setProperty('views', $value);
    }

//<< Properties
}

?>
