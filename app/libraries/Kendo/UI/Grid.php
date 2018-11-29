<?php

namespace Kendo\UI;

class Grid extends \Kendo\UI\Widget {
    protected function name() {
        return 'Grid';
    }
//>> Properties

    /**
    * If set to true and selection of the Grid is enabled the user could copy the selection into the clipboard and paste it into Excel or other similar programs that understand TSV/CSV formats. By default allowCopy is disabled and the default format is TSV. Can be set to a JavaScript object which represents the allowCopy configuration.
    * @param boolean|\Kendo\UI\GridAllowCopy|array $value
    * @return \Kendo\UI\Grid
    */
    public function allowCopy($value) {
        return $this->setProperty('allowCopy', $value);
    }

    /**
    * If set to false, the Grid will not bind to the data source during initialization, i.e. it will not call the fetch method of the dataSource instance. In such scenarios data binding will occur when the change event of the dataSource instance is fired. By default, autoBind is set to true and the widget will bind to the data source specified in the configuration.
    * @param boolean $value
    * @return \Kendo\UI\Grid
    */
    public function autoBind($value) {
        return $this->setProperty('autoBind', $value);
    }

    /**
    * Defines the width of the column resize handle in pixels. Apply a larger value for easier grasping.
    * @param float $value
    * @return \Kendo\UI\Grid
    */
    public function columnResizeHandleWidth($value) {
        return $this->setProperty('columnResizeHandleWidth', $value);
    }

    /**
    * Adds GridColumn to the Grid.
    * @param \Kendo\UI\GridColumn|array,... $value one or more GridColumn to add.
    * @return \Kendo\UI\Grid
    */
    public function addColumn($value) {
        return $this->add('columns', func_get_args());
    }

    /**
    * If set to true the grid will display the column menu when the user clicks the chevron icon in the column headers. The column menu allows the user to show and hide columns, filter and sort (if filtering and sorting are enabled). By default the column menu is not enabled.Can be set to a JavaScript object which represents the column menu configuration.
    * @param boolean|\Kendo\UI\GridColumnMenu|array $value
    * @return \Kendo\UI\Grid
    */
    public function columnMenu($value) {
        return $this->setProperty('columnMenu', $value);
    }

    /**
    * Sets the data source of the Grid.
    * @param array|\Kendo\Data\DataSource $value
    * @return \Kendo\UI\Grid
    */
    public function dataSource($value) {
        return $this->setProperty('dataSource', $value);
    }

    /**
    * If set to true the user would be able to edit the data to which the grid is bound. By default editing is disabled.Can be set to a string ("inline", "incell" or "popup") to specify the editing mode. The default editing mode is "incell".Can be set to a JavaScript object which represents the editing configuration.
    * @param boolean|string|\Kendo\UI\GridEditable|array $value
    * @return \Kendo\UI\Grid
    */
    public function editable($value) {
        return $this->setProperty('editable', $value);
    }

    /**
    * Configures the Kendo UI Grid Excel export settings.
    * @param \Kendo\UI\GridExcel|array $value
    * @return \Kendo\UI\Grid
    */
    public function excel($value) {
        return $this->setProperty('excel', $value);
    }

    /**
    * If set to true the user can filter the data source using the grid filter menu. Filtering is disabled by default.Can be set to a JavaScript object which represents the filter menu configuration.
    * @param boolean|\Kendo\UI\GridFilterable|array $value
    * @return \Kendo\UI\Grid
    */
    public function filterable($value) {
        return $this->setProperty('filterable', $value);
    }

    /**
    * If set to true the user could group the grid by dragging the column header cells. By default grouping is disabled.Can be set to a JavaScript object which represents the grouping configuration.
    * @param boolean|\Kendo\UI\GridGroupable|array $value
    * @return \Kendo\UI\Grid
    */
    public function groupable($value) {
        return $this->setProperty('groupable', $value);
    }

    /**
    * The height of the grid. Numeric values are treated as pixels.
    * @param float|string $value
    * @return \Kendo\UI\Grid
    */
    public function height($value) {
        return $this->setProperty('height', $value);
    }

    /**
    * Defines the text of the command buttons that are shown within the Grid. Used primarily for localization.
    * @param \Kendo\UI\GridMessages|array $value
    * @return \Kendo\UI\Grid
    */
    public function messages($value) {
        return $this->setProperty('messages', $value);
    }

    /**
    * If set to true and the grid is viewed on mobile browser it will use adaptive rendering.Can be set to a string phone or tablet which will force the widget to use adaptive rendering regardless of browser type. The grid uses same layout for both phone and tablet.
    * @param boolean|string $value
    * @return \Kendo\UI\Grid
    */
    public function mobile($value) {
        return $this->setProperty('mobile', $value);
    }

    /**
    * If set to true the use could navigate the widget using the keyboard navigation. By default keyboard navigation is disabled.
    * @param boolean $value
    * @return \Kendo\UI\Grid
    */
    public function navigatable($value) {
        return $this->setProperty('navigatable', $value);
    }

    /**
    * If set to true and current view contains no records, message similar to "No records available" will be displayed. By default this option is disabled.
    * @param boolean|\Kendo\UI\GridNoRecords|array $value
    * @return \Kendo\UI\Grid
    */
    public function noRecords($value) {
        return $this->setProperty('noRecords', $value);
    }

    /**
    * If set to true the grid will display a pager. By default paging is disabled.Can be set to a JavaScript object which represents the pager configuration.
    * @param boolean|\Kendo\UI\GridPageable|array $value
    * @return \Kendo\UI\Grid
    */
    public function pageable($value) {
        return $this->setProperty('pageable', $value);
    }

    /**
    * Configures the Kendo UI Grid PDF export settings.
    * @param \Kendo\UI\GridPdf|array $value
    * @return \Kendo\UI\Grid
    */
    public function pdf($value) {
        return $this->setProperty('pdf', $value);
    }

    /**
    * Sets a value indicating whether the selection will be persisted when sorting, paging, filtering and etc are performed.
    * @param boolean $value
    * @return \Kendo\UI\Grid
    */
    public function persistSelection($value) {
        return $this->setProperty('persistSelection', $value);
    }

    /**
    * If set to true the user could reorder the columns by dragging their header cells. By default reordering is disabled. Multi-level headers allow reordering only in same level.
    * @param boolean $value
    * @return \Kendo\UI\Grid
    */
    public function reorderable($value) {
        return $this->setProperty('reorderable', $value);
    }

    /**
    * If set to true, users can resize columns by dragging the edges (resize handles) of their header cells. As of Kendo UI Q1 2015, users can also auto-fit a column by double-clicking its resize handle. In this case the column will assume the smallest possible width, which allows the column content to fit without wrapping.By default, column resizing is disabled.
    * @param boolean $value
    * @return \Kendo\UI\Grid
    */
    public function resizable($value) {
        return $this->setProperty('resizable', $value);
    }

    /**
    * If set to true the grid will display a scrollbar when the total row height (or width) exceeds the grid height (or width). By default scrolling is enabled.Can be set to a JavaScript object which represents the scrolling configuration.
    * @param boolean|\Kendo\UI\GridScrollable|array $value
    * @return \Kendo\UI\Grid
    */
    public function scrollable($value) {
        return $this->setProperty('scrollable', $value);
    }

    /**
    * If set to true the user would be able to select grid rows. By default selection is disabled.Can also be set to the following string values: "row" - the user can select a single row.; "cell" - the user can select a single cell.; "multiple, row" - the user can select multiple rows. or "multiple, cell" - the user can select multiple cells..
    * @param boolean|string $value
    * @return \Kendo\UI\Grid
    */
    public function selectable($value) {
        return $this->setProperty('selectable', $value);
    }

    /**
    * If set to true the user could sort the grid by clicking the column header cells. By default sorting is disabled.Can be set to a JavaScript object which represents the sorting configuration.
    * @param boolean|\Kendo\UI\GridSortable|array $value
    * @return \Kendo\UI\Grid
    */
    public function sortable($value) {
        return $this->setProperty('sortable', $value);
    }

    /**
    * Adds GridToolbarItem to the Grid.
    * @param \Kendo\UI\GridToolbarItem|array,... $value one or more GridToolbarItem to add.
    * @return \Kendo\UI\Grid
    */
    public function addToolbarItem($value) {
        return $this->add('toolbar', func_get_args());
    }

    /**
    * Sets the detailTemplate option of the Grid.
    * The id of the template used for rendering the detail rows in the grid.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\Grid
    */
    public function detailTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('detailTemplate', $value);
    }

    /**
    * Sets the detailTemplate option of the Grid.
    * The id of the template used for rendering the detail rows in the grid.
    * @param string $value The template content.
    * @return \Kendo\UI\Grid
    */
    public function detailTemplate($value) {
        return $this->setProperty('detailTemplate', $value);
    }

    /**
    * Sets the rowTemplate option of the Grid.
    * The id of the template used for rendering the rows in the grid.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\Grid
    */
    public function rowTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('rowTemplate', $value);
    }

    /**
    * Sets the rowTemplate option of the Grid.
    * The id of the template used for rendering the rows in the grid.
    * @param string $value The template content.
    * @return \Kendo\UI\Grid
    */
    public function rowTemplate($value) {
        return $this->setProperty('rowTemplate', $value);
    }

    /**
    * Sets the altRowTemplate option of the Grid.
    * The id of the template used for rendering the alternate rows in the grid.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\Grid
    */
    public function altRowTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('altRowTemplate', $value);
    }

    /**
    * Sets the altRowTemplate option of the Grid.
    * The id of the template used for rendering the alternate rows in the grid.
    * @param string $value The template content.
    * @return \Kendo\UI\Grid
    */
    public function altRowTemplate($value) {
        return $this->setProperty('altRowTemplate', $value);
    }

    /**
    * Sets the beforeEdit event of the Grid.
    * Fired when the user try to edit or create a data item, before the editor is created. Can be used for preventing the editing depending on custom logic.The event handler function context (available via the this keyword) will be set to the widget instance.The event will be fired only when the Grid is selectable.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function beforeEdit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('beforeEdit', $value);
    }

    /**
    * Sets the cancel event of the Grid.
    * Fired when the user clicks the "cancel" button (in inline or popup editing mode) or closes the popup window.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function cancel($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('cancel', $value);
    }

    /**
    * Sets the cellClose event of the Grid.
    * Fired when "incell" edit mode is used and the cell is going to be closed. The event is triggerd after saving or canceling the changes, but before the cell is closed.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function cellClose($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('cellClose', $value);
    }

    /**
    * Sets the change event of the Grid.
    * Fired when the user selects a table row or cell in the grid.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function change($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('change', $value);
    }

    /**
    * Sets the columnHide event of the Grid.
    * Fired when the user hides a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnHide($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnHide', $value);
    }

    /**
    * Sets the columnLock event of the Grid.
    * Fired when the user lock a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnLock($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnLock', $value);
    }

    /**
    * Sets the columnMenuInit event of the Grid.
    * Fired when the column menu is initialized.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnMenuInit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnMenuInit', $value);
    }

    /**
    * Sets the columnMenuOpen event of the Grid.
    * Fired when the grid column menu is opened, after the animations are completed.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnMenuOpen($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnMenuOpen', $value);
    }

    /**
    * Sets the columnReorder event of the Grid.
    * Fired when the user changes the order of a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnReorder($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnReorder', $value);
    }

    /**
    * Sets the columnResize event of the Grid.
    * Fired when the user resizes a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnResize($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnResize', $value);
    }

    /**
    * Sets the columnShow event of the Grid.
    * Fired when the user shows a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnShow($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnShow', $value);
    }

    /**
    * Sets the columnUnlock event of the Grid.
    * Fired when the user unlock a column.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function columnUnlock($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('columnUnlock', $value);
    }

    /**
    * Sets the dataBinding event of the Grid.
    * Fired before the widget binds to its data source.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function dataBinding($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('dataBinding', $value);
    }

    /**
    * Sets the dataBound event of the Grid.
    * Fired when the widget is bound to data from its data source.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function dataBound($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('dataBound', $value);
    }

    /**
    * Sets the detailCollapse event of the Grid.
    * Fired when the user collapses a detail table row.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function detailCollapse($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('detailCollapse', $value);
    }

    /**
    * Sets the detailExpand event of the Grid.
    * Fired when the user expands a detail table row.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function detailExpand($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('detailExpand', $value);
    }

    /**
    * Sets the detailInit event of the Grid.
    * Fired when a detail table row is initialized.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function detailInit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('detailInit', $value);
    }

    /**
    * Sets the edit event of the Grid.
    * Fired when the user edits or creates a data item.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function edit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('edit', $value);
    }

    /**
    * Sets the excelExport event of the Grid.
    * Fired when the user clicks the "Export to Excel" toolbar button.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function excelExport($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('excelExport', $value);
    }

    /**
    * Sets the filter event of the Grid.
    * Fired when the user is about to filter the DataSource via the filter UI.The event handler function context (available via the this keyword) will be set to the widget instance.Introduced in the Kendo UI 2016 R3 (2016.3.914) release.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function filter($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('filter', $value);
    }

    /**
    * Sets the filterMenuInit event of the Grid.
    * Fired when the grid filter menu is initialized, when it is opened for the first time.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function filterMenuInit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('filterMenuInit', $value);
    }

    /**
    * Sets the filterMenuOpen event of the Grid.
    * Fired when the grid filter menu is opened, after the animations are completed.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function filterMenuOpen($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('filterMenuOpen', $value);
    }

    /**
    * Sets the group event of the Grid.
    * Fired when the user is about to group the DataSource or modify the group descriptors state via the Grid group panel.The event handler function context (available via the this keyword) will be set to the widget instance.Introduced in the Kendo UI 2016 R3 (2016.3.914) release.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function group($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('group', $value);
    }

    /**
    * Sets the groupCollapse event of the Grid.
    * Fired when the user collapses a group row.The event handler function context (available via the this keyword) will be set to the widget instance.Introduced in the Kendo UI 2017 R3 (2017.3.913) release.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function groupCollapse($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('groupCollapse', $value);
    }

    /**
    * Sets the groupExpand event of the Grid.
    * Fired when the user expands a group row.The event handler function context (available via the this keyword) will be set to the widget instance.Introduced in the Kendo UI 2017 R3 (2017.3.913) release.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function groupExpand($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('groupExpand', $value);
    }

    /**
    * Sets the navigate event of the Grid.
    * Fired when navigatable is enabled and the user change current item with either mouse or keyboard interaction.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function navigate($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('navigate', $value);
    }

    /**
    * Sets the page event of the Grid.
    * Fired when the user is about change the current page index of DataSource via the pager UI.The event handler function context (available via the this keyword) will be set to the widget instance.Introduced in the Kendo UI 2016 R3 (2016.3.914) release.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function page($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('page', $value);
    }

    /**
    * Sets the pdfExport event of the Grid.
    * Fired when the user clicks the "Export to PDF" toolbar button.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function pdfExport($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('pdfExport', $value);
    }

    /**
    * Sets the remove event of the Grid.
    * Fired when the user clicks the "destroy" command button and delete operation is confirmed in the confirmation window, if the cancel button in the window is clicked the event will not be fired.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function remove($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('remove', $value);
    }

    /**
    * Sets the save event of the Grid.
    * Fired when a data item is saved.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function save($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('save', $value);
    }

    /**
    * Sets the saveChanges event of the Grid.
    * Fired when the user clicks the "save" command button.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function saveChanges($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('saveChanges', $value);
    }

    /**
    * Sets the sort event of the Grid.
    * Fired when the user is about to modify the current state of sort descriptors of DataSource via the sort UI.The event handler function context (available via the this keyword) will be set to the widget instance.Introduced in the Kendo UI 2016 R3 (2016.3.914) release.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Grid
    */
    public function sort($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('sort', $value);
    }


//<< Properties

    /**
    * Sets the toolbar option of the Grid.
    * The id of the template used for rendering the toolbar in the grid.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\Grid
    */
    public function toolbarTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('toolbar', $value);
    }
}

?>
