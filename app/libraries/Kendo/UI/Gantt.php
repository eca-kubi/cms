<?php

namespace Kendo\UI;

class Gantt extends \Kendo\UI\Widget {
    public function name() {
        return 'Gantt';
    }
//>> Properties

    /**
    * The configuration of the assignments of the gantt resources. An assignment is a one-to-one mapping between a gantt task and a gantt resource containing the number of units for which a resource is assigned to a task.
    * @param \Kendo\UI\GanttAssignments|array $value
    * @return \Kendo\UI\Gantt
    */
    public function assignments($value) {
        return $this->setProperty('assignments', $value);
    }

    /**
    * If set to false the widget will not bind to the data source during initialization. In this case data binding will occur when the change event of the data source is fired. By default the widget will bind to the data source specified in the configuration.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function autoBind($value) {
        return $this->setProperty('autoBind', $value);
    }

    /**
    * Defines the width of the column resize handle in pixels. Apply a larger value for easier grasping.
    * @param float $value
    * @return \Kendo\UI\Gantt
    */
    public function columnResizeHandleWidth($value) {
        return $this->setProperty('columnResizeHandleWidth', $value);
    }

    /**
    * Adds GanttColumn to the Gantt.
    * @param \Kendo\UI\GanttColumn|array,... $value one or more GanttColumn to add.
    * @return \Kendo\UI\Gantt
    */
    public function addColumn($value) {
        return $this->add('columns', func_get_args());
    }

    /**
    * If set to false the "current time" marker of the Gantt would not be displayed.
    * @param boolean|\Kendo\UI\GanttCurrentTimeMarker|array $value
    * @return \Kendo\UI\Gantt
    */
    public function currentTimeMarker($value) {
        return $this->setProperty('currentTimeMarker', $value);
    }

    /**
    * Sets the data source of the Gantt.
    * @param array|\Kendo\Data\DataSource $value
    * @return \Kendo\UI\Gantt
    */
    public function dataSource($value) {
        return $this->setProperty('dataSource', $value);
    }

    /**
    * If set to some date and it is between the range start and range end of the selected view, the timeline of the currently selected view is scrolled to start from this date.
    * @param date $value
    * @return \Kendo\UI\Gantt
    */
    public function date($value) {
        return $this->setProperty('date', $value);
    }

    /**
    * The data source of the widget which contains the dependencies. Can be a JavaScript object which represents a valid data source configuration, a JavaScript array or an existing kendo.data.GanttDependencyDataSource instance.If the dependencies option is set to a JavaScript object or array the widget will initialize a new kendo.data.GanttDependencyDataSource instance using that value as data source configuration.If the dependencies option is an existing kendo.data.GanttDependencyDataSource instance the widget will use that instance and will not initialize a new one.
    * @param |array| $value
    * @return \Kendo\UI\Gantt
    */
    public function dependencies($value) {
        return $this->setProperty('dependencies', $value);
    }

    /**
    * If set to false the user won't be able to create, modify or delete tasks and dependencies.
    * @param boolean|\Kendo\UI\GanttEditable|array $value
    * @return \Kendo\UI\Gantt
    */
    public function editable($value) {
        return $this->setProperty('editable', $value);
    }

    /**
    * If set to true the user could navigate the widget using the keyboard. By default keyboard navigation is disabled.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function navigatable($value) {
        return $this->setProperty('navigatable', $value);
    }

    /**
    * Sets the start of the work day.
    * @param date $value
    * @return \Kendo\UI\Gantt
    */
    public function workDayStart($value) {
        return $this->setProperty('workDayStart', $value);
    }

    /**
    * Sets the end of the work day.
    * @param date $value
    * @return \Kendo\UI\Gantt
    */
    public function workDayEnd($value) {
        return $this->setProperty('workDayEnd', $value);
    }

    /**
    * The start of working week (index based).
    * @param float $value
    * @return \Kendo\UI\Gantt
    */
    public function workWeekStart($value) {
        return $this->setProperty('workWeekStart', $value);
    }

    /**
    * The end of working week (index based).
    * @param float $value
    * @return \Kendo\UI\Gantt
    */
    public function workWeekEnd($value) {
        return $this->setProperty('workWeekEnd', $value);
    }

    /**
    * The span of an hour slot.
    * @param float $value
    * @return \Kendo\UI\Gantt
    */
    public function hourSpan($value) {
        return $this->setProperty('hourSpan', $value);
    }

    /**
    * If set to true the Gantt will snap tasks to the nearest slot during dragging (resizing or moving). Set it to false to allow free moving and resizing of tasks.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function snap($value) {
        return $this->setProperty('snap', $value);
    }

    /**
    * The height of the widget. Numeric values are treated as pixels.
    * @param float|string $value
    * @return \Kendo\UI\Gantt
    */
    public function height($value) {
        return $this->setProperty('height', $value);
    }

    /**
    * The width of the task list. Numeric values are treated as pixels.
    * @param string|float $value
    * @return \Kendo\UI\Gantt
    */
    public function listWidth($value) {
        return $this->setProperty('listWidth', $value);
    }

    /**
    * The configuration of the Gantt messages. Use this option to customize or localize the Gantt messages.
    * @param \Kendo\UI\GanttMessages|array $value
    * @return \Kendo\UI\Gantt
    */
    public function messages($value) {
        return $this->setProperty('messages', $value);
    }

    /**
    * Configures the Kendo UI Gantt PDF export settings.
    * @param \Kendo\UI\GanttPdf|array $value
    * @return \Kendo\UI\Gantt
    */
    public function pdf($value) {
        return $this->setProperty('pdf', $value);
    }

    /**
    * Configures the Kendo UI Gantt range settings.
    * @param \Kendo\UI\GanttRange|array $value
    * @return \Kendo\UI\Gantt
    */
    public function range($value) {
        return $this->setProperty('range', $value);
    }

    /**
    * If set to true allows users to resize columns by dragging their header borders. By default resizing is disabled.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function resizable($value) {
        return $this->setProperty('resizable', $value);
    }

    /**
    * If set to false the user won't be able to select tasks in the Gantt. By default selection is enabled and triggers the change event.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function selectable($value) {
        return $this->setProperty('selectable', $value);
    }

    /**
    * If set to false, Gantt views will show all days of the week. By default the views display only business days.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function showWorkDays($value) {
        return $this->setProperty('showWorkDays', $value);
    }

    /**
    * If set to false, the day view will show all hours of the day. By default the view displays only business hours.
    * @param boolean $value
    * @return \Kendo\UI\Gantt
    */
    public function showWorkHours($value) {
        return $this->setProperty('showWorkHours', $value);
    }

    /**
    * Sets the taskTemplate option of the Gantt.
    * The template used to render the gantt tasks.The fields which can be used in the template are the task fields
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\Gantt
    */
    public function taskTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('taskTemplate', $value);
    }

    /**
    * Sets the taskTemplate option of the Gantt.
    * The template used to render the gantt tasks.The fields which can be used in the template are the task fields
    * @param string $value The template content.
    * @return \Kendo\UI\Gantt
    */
    public function taskTemplate($value) {
        return $this->setProperty('taskTemplate', $value);
    }

    /**
    * Adds GanttToolbarItem to the Gantt.
    * @param \Kendo\UI\GanttToolbarItem|array,... $value one or more GanttToolbarItem to add.
    * @return \Kendo\UI\Gantt
    */
    public function addToolbarItem($value) {
        return $this->add('toolbar', func_get_args());
    }

    /**
    * The task tooltip configuration options.
    * @param \Kendo\UI\GanttTooltip|array $value
    * @return \Kendo\UI\Gantt
    */
    public function tooltip($value) {
        return $this->setProperty('tooltip', $value);
    }

    /**
    * Adds GanttView to the Gantt.
    * @param \Kendo\UI\GanttView|array,... $value one or more GanttView to add.
    * @return \Kendo\UI\Gantt
    */
    public function addView($value) {
        return $this->add('views', func_get_args());
    }

    /**
    * The configuration of the gantt resource(s). A gantt resource is optional metadata that can be associated with a gantt task.
    * @param \Kendo\UI\GanttResources|array $value
    * @return \Kendo\UI\Gantt
    */
    public function resources($value) {
        return $this->setProperty('resources', $value);
    }

    /**
    * The height of the table rows. Numeric values are treated as pixels.
    * @param float|string $value
    * @return \Kendo\UI\Gantt
    */
    public function rowHeight($value) {
        return $this->setProperty('rowHeight', $value);
    }

    /**
    * Sets the dataBinding event of the Gantt.
    * Fired before the widget binds to its data source.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function dataBinding($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('dataBinding', $value);
    }

    /**
    * Sets the dataBound event of the Gantt.
    * Fired when the widget is bound to data from its data source.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function dataBound($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('dataBound', $value);
    }

    /**
    * Sets the add event of the Gantt.
    * Fired when a new task or a new dependency is about to be added.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function addEvent($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('add', $value);
    }

    /**
    * Sets the edit event of the Gantt.
    * Fired when the user starts task edit upon double click on a cell.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function edit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('edit', $value);
    }

    /**
    * Sets the remove event of the Gantt.
    * Fired when a task or a dependency is about to be removed.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function remove($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('remove', $value);
    }

    /**
    * Sets the cancel event of the Gantt.
    * Fired when the user cancels tasks's cell editing by pressing the 'Esc' key.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function cancel($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('cancel', $value);
    }

    /**
    * Sets the save event of the Gantt.
    * Fired when a task field is updated upon user interaction.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function save($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('save', $value);
    }

    /**
    * Sets the change event of the Gantt.
    * Fired when the user selects a task in the Gantt.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function change($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('change', $value);
    }

    /**
    * Sets the columnResize event of the Gantt.
    * Fired when the user resizes a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function columnResize($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnResize', $value);
    }

    /**
    * Sets the navigate event of the Gantt.
    * Fired when the user changes the selected view of the Gantt.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function navigate($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('navigate', $value);
    }

    /**
    * Sets the moveStart event of the Gantt.
    * Fired when the user starts to drag a task.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function moveStart($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('moveStart', $value);
    }

    /**
    * Sets the move event of the Gantt.
    * Fired when the user is moving a task.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function move($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('move', $value);
    }

    /**
    * Sets the moveEnd event of the Gantt.
    * Fired when the user stops moving a task.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function moveEnd($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('moveEnd', $value);
    }

    /**
    * Sets the pdfExport event of the Gantt.
    * Fired when the user clicks the "Export to PDF" toolbar button.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function pdfExport($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('pdfExport', $value);
    }

    /**
    * Sets the resizeStart event of the Gantt.
    * Fired when the user starts to resize a task.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function resizeStart($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('resizeStart', $value);
    }

    /**
    * Sets the resize event of the Gantt.
    * Fired when the user is resizing a task.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function resize($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('resize', $value);
    }

    /**
    * Sets the resizeEnd event of the Gantt.
    * Fired when the user releases the mouse after resizing a task.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Gantt
    */
    public function resizeEnd($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('resizeEnd', $value);
    }


//<< Properties
}

?>
