<?php

namespace Kendo\UI;

class MultiColumnComboBox extends \Kendo\UI\Widget {
    public function name() {
        return 'MultiColumnComboBox';
    }
//>> Properties

    /**
    * Configures the opening and closing animations of the suggestion popup. Setting the animation option to false will disable the opening and closing animations. As a result the suggestion popup will open and close instantly.
    * @param \Kendo\UI\MultiColumnComboBoxAnimation|array $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function animation($value) {
        return $this->setProperty('animation', $value);
    }

    /**
    * Controls whether to bind the widget to the data source on initialization.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function autoBind($value) {
        return $this->setProperty('autoBind', $value);
    }

    /**
    * Use it to set the Id of the parent MultiColumnComboBox widget.Help topic showing how cascading functionality works
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function cascadeFrom($value) {
        return $this->setProperty('cascadeFrom', $value);
    }

    /**
    * Defines the field to be used to filter the data source. If not defined the parent's dataValueField option will be used.Help topic showing how cascading functionality works
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function cascadeFromField($value) {
        return $this->setProperty('cascadeFromField', $value);
    }

    /**
    * Defines the parent field to be used to retain value from. This value will be used further to filter the dataSource. If not defined the value from the parent's dataValueField will be used.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function cascadeFromParentField($value) {
        return $this->setProperty('cascadeFromParentField', $value);
    }

    /**
    * Adds MultiColumnComboBoxColumn to the MultiColumnComboBox.
    * @param \Kendo\UI\MultiColumnComboBoxColumn|array,... $value one or more MultiColumnComboBoxColumn to add.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function addColumn($value) {
        return $this->add('columns', func_get_args());
    }

    /**
    * Unless this options is set to false, a button will appear when hovering the widget. Clicking that button will reset the widget's value and will trigger the change event.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function clearButton($value) {
        return $this->setProperty('clearButton', $value);
    }

    /**
    * Sets the data source of the MultiColumnComboBox.
    * @param array|\Kendo\Data\DataSource $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function dataSource($value) {
        return $this->setProperty('dataSource', $value);
    }

    /**
    * The field of the data item that provides the text content of the list items. The widget will filter the data source based on this field.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function dataTextField($value) {
        return $this->setProperty('dataTextField', $value);
    }

    /**
    * The field of the data item that provides the value of the widget.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function dataValueField($value) {
        return $this->setProperty('dataValueField', $value);
    }

    /**
    * The delay in milliseconds between a keystroke and when the widget displays the popup.
    * @param float $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function delay($value) {
        return $this->setProperty('delay', $value);
    }

    /**
    * The width of the dropdown. Numeric values are treated as pixels.
    * @param string|float $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function dropDownWidth($value) {
        return $this->setProperty('dropDownWidth', $value);
    }

    /**
    * If set to false the widget will be disabled and will not allow user input. The widget is enabled by default and allows user input.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function enable($value) {
        return $this->setProperty('enable', $value);
    }

    /**
    * If set to true the widget will not show all items when the text of the search input cleared. By default the widget shows all items when the text of the search input is cleared. Works in conjunction with minLength.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function enforceMinLength($value) {
        return $this->setProperty('enforceMinLength', $value);
    }

    /**
    * The filtering method used to determine the suggestions for the current value. Filtration is turned off by default, and can be performed over string values only (either the widget's data has to be an array of strings, or over the field, configured in the dataTextField option). The supported filter values are startswith, endswith and contains.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function filter($value) {
        return $this->setProperty('filter', $value);
    }

    /**
    * Enables multicolumn filtering.
    * @param array $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function filterFields($value) {
        return $this->setProperty('filterFields', $value);
    }

    /**
    * Sets the fixedGroupTemplate option of the MultiColumnComboBox.
    * The template used to render the fixed header group. By default the widget displays only the value of the current group.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function fixedGroupTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('fixedGroupTemplate', $value);
    }

    /**
    * Sets the fixedGroupTemplate option of the MultiColumnComboBox.
    * The template used to render the fixed header group. By default the widget displays only the value of the current group.
    * @param string $value The template content.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function fixedGroupTemplate($value) {
        return $this->setProperty('fixedGroupTemplate', $value);
    }

    /**
    * Sets the footerTemplate option of the MultiColumnComboBox.
    * The template used to render the footer template. The footer template receives the widget itself as a part of the data argument. Use the widget fields directly in the template.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function footerTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('footerTemplate', $value);
    }

    /**
    * Sets the footerTemplate option of the MultiColumnComboBox.
    * The template used to render the footer template. The footer template receives the widget itself as a part of the data argument. Use the widget fields directly in the template.
    * @param string $value The template content.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function footerTemplate($value) {
        return $this->setProperty('footerTemplate', $value);
    }

    /**
    * Sets the groupTemplate option of the MultiColumnComboBox.
    * The template used to render the groups. By default the widget displays only the value of the group.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function groupTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('groupTemplate', $value);
    }

    /**
    * Sets the groupTemplate option of the MultiColumnComboBox.
    * The template used to render the groups. By default the widget displays only the value of the group.
    * @param string $value The template content.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function groupTemplate($value) {
        return $this->setProperty('groupTemplate', $value);
    }

    /**
    * The height of the suggestion popup in pixels. The default value is 200 pixels.
    * @param float $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function height($value) {
        return $this->setProperty('height', $value);
    }

    /**
    * If set to true the first suggestion will be automatically highlighted.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function highlightFirst($value) {
        return $this->setProperty('highlightFirst', $value);
    }

    /**
    * If set to false case-sensitive search will be performed to find suggestions. The widget performs case-insensitive searching by default.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function ignoreCase($value) {
        return $this->setProperty('ignoreCase', $value);
    }

    /**
    * The index of the initially selected item. The index is 0 based.
    * @param float $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function index($value) {
        return $this->setProperty('index', $value);
    }

    /**
    * The minimum number of characters the user must type before a search is performed. Set to higher value than 1 if the search could match a lot of items.
    * @param float $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function minLength($value) {
        return $this->setProperty('minLength', $value);
    }

    /**
    * Sets the noDataTemplate option of the MultiColumnComboBox.
    * The template used to render the "no data" template, which will be displayed if no results are found or the underlying data source is empty. The noData template receives the widget itself as a part of the data argument. The template will be evaluated on every widget data bound.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function noDataTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('noDataTemplate', $value);
    }

    /**
    * Sets the noDataTemplate option of the MultiColumnComboBox.
    * The template used to render the "no data" template, which will be displayed if no results are found or the underlying data source is empty. The noData template receives the widget itself as a part of the data argument. The template will be evaluated on every widget data bound.
    * @param string $value The template content.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function noDataTemplate($value) {
        return $this->setProperty('noDataTemplate', $value);
    }

    /**
    * The hint displayed by the widget when it is empty. Not set by default.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function placeholder($value) {
        return $this->setProperty('placeholder', $value);
    }

    /**
    * The options that will be used for the popup initialization. For more details about the available options refer to Popup documentation.
    * @param \Kendo\UI\MultiColumnComboBoxPopup|array $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function popup($value) {
        return $this->setProperty('popup', $value);
    }

    /**
    * If set to true the widget will automatically use the first suggestion as its value.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function suggest($value) {
        return $this->setProperty('suggest', $value);
    }

    /**
    * When set to true the widget will automatically set selected value to the typed custom text. Set the option to false to clear the selected value but keep the custom text.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function syncValueAndText($value) {
        return $this->setProperty('syncValueAndText', $value);
    }

    /**
    * Sets the headerTemplate option of the MultiColumnComboBox.
    * Specifies a static HTML content, which will be rendered as a header of the popup element.
    * @param string $value The id of the element which represents the kendo template.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function headerTemplateId($value) {
        $value = new \Kendo\Template($value);

        return $this->setProperty('headerTemplate', $value);
    }

    /**
    * Sets the headerTemplate option of the MultiColumnComboBox.
    * Specifies a static HTML content, which will be rendered as a header of the popup element.
    * @param string $value The template content.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function headerTemplate($value) {
        return $this->setProperty('headerTemplate', $value);
    }

    /**
    * The text of the widget used when the autoBind is set to false.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function text($value) {
        return $this->setProperty('text', $value);
    }

    /**
    * The value of the widget.
    * @param string $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function value($value) {
        return $this->setProperty('value', $value);
    }

    /**
    * Specifies the value binding behavior for the widget when the initial model value is null. If set to true, the View-Model field will be updated with the selected item value field. If set to false, the View-Model field will be updated with the selected item.
    * @param boolean $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function valuePrimitive($value) {
        return $this->setProperty('valuePrimitive', $value);
    }

    /**
    * Enables the virtualization feature of the widget. The configuration can be set on an object, which contains two properties - itemHeight and valueMapper.For detailed information, refer to the article on virtualization.
    * @param boolean|\Kendo\UI\MultiColumnComboBoxVirtual|array $value
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function virtual($value) {
        return $this->setProperty('virtual', $value);
    }

    /**
    * Sets the change event of the MultiColumnComboBox.
    * Fired when the value of the widget is changed by the user. As of 2015 Q3 SP1 cascading widget will trigger change event when its value is changed due to parent update.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function change($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('change', $value);
    }

    /**
    * Sets the close event of the MultiColumnComboBox.
    * Fired when the popup of the widget is closed.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function close($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('close', $value);
    }

    /**
    * Sets the dataBound event of the MultiColumnComboBox.
    * Fired when the widget is bound to data from its data source.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function dataBound($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('dataBound', $value);
    }

    /**
    * Sets the filtering event of the MultiColumnComboBox.
    * Fired when the widget is about to filter the data source.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function filtering($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('filtering', $value);
    }

    /**
    * Sets the open event of the MultiColumnComboBox.
    * Fired when the popup of the widget is opened by the user.The event handler function context (available via the this keyword) will be set to the widget instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function open($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('open', $value);
    }

    /**
    * Sets the select event of the MultiColumnComboBox.
    * Fired when an item from the popup is selected by the user either with mouse/tap or with keyboard navigation.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function select($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('select', $value);
    }

    /**
    * Sets the cascade event of the MultiColumnComboBox.
    * Fired when the value of the widget is changed via API or user interaction.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\MultiColumnComboBox
    */
    public function cascade($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('cascade', $value);
    }


//<< Properties
}

?>
