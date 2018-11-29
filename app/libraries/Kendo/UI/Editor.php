<?php

namespace Kendo\UI;

class Editor extends \Kendo\UI\Widget {
    protected $ignore = array('content', 'tag');

    protected function name() {
        return 'Editor';
    }

    protected function createElement() {
        $tag = $this->getProperty('tag');

        if (gettype($tag) != 'string') {
            $tag = 'textarea';
        }

        $element = new \Kendo\Html\Element($tag);

        if ($tag != 'textarea') {
            $element->attr('contentEditable', 'true');
        }

        $content = $this->getProperty('content');

        if (gettype($content) == "string") {
            $element->html($content);
        }

        return $element;
    }
//>> Properties

    /**
    * Fine-tune deserialization in the Editor widget. Deserialization is the process of parsing the HTML string input from the value() method or from the viewHtml dialog into editable content.
    * @param \Kendo\UI\EditorDeserialization|array $value
    * @return \Kendo\UI\Editor
    */
    public function deserialization($value) {
        return $this->setProperty('deserialization', $value);
    }

    /**
    * Relaxes the same-origin policy when using the iframe-based editor. This is done automatically for all cases except when the policy is relaxed by document.domain = document.domain. In that case, this property must be used to allow the editor to function properly across browsers. This property has been introduced in internal builds after 2014.1.319.
    * @param string $value
    * @return \Kendo\UI\Editor
    */
    public function domain($value) {
        return $this->setProperty('domain', $value);
    }

    /**
    * Indicates whether the Editor should submit encoded HTML tags. By default, the submitted value is encoded.
    * @param boolean $value
    * @return \Kendo\UI\Editor
    */
    public function encoded($value) {
        return $this->setProperty('encoded', $value);
    }

    /**
    * If enabled, the editor disables the editing and command execution in elements marked with editablecontent="false" attribute.
    * @param boolean|\Kendo\UI\EditorImmutables|array $value
    * @return \Kendo\UI\Editor
    */
    public function immutables($value) {
        return $this->setProperty('immutables', $value);
    }

    /**
    * Defines the text of the labels that are shown within the editor. Used primarily for localization.
    * @param \Kendo\UI\EditorMessages|array $value
    * @return \Kendo\UI\Editor
    */
    public function messages($value) {
        return $this->setProperty('messages', $value);
    }

    /**
    * Options for controlling how the pasting content is modified before it is added in the editor.
    * @param \Kendo\UI\EditorPasteCleanup|array $value
    * @return \Kendo\UI\Editor
    */
    public function pasteCleanup($value) {
        return $this->setProperty('pasteCleanup', $value);
    }

    /**
    * Configures the Kendo UI Editor PDF export settings.
    * @param \Kendo\UI\EditorPdf|array $value
    * @return \Kendo\UI\Editor
    */
    public function pdf($value) {
        return $this->setProperty('pdf', $value);
    }

    /**
    * If enabled, the editor renders a resize handle to allow users to resize it.
    * @param boolean|\Kendo\UI\EditorResizable|array $value
    * @return \Kendo\UI\Editor
    */
    public function resizable($value) {
        return $this->setProperty('resizable', $value);
    }

    /**
    * Allows setting of serialization options.
    * @param \Kendo\UI\EditorSerialization|array $value
    * @return \Kendo\UI\Editor
    */
    public function serialization($value) {
        return $this->setProperty('serialization', $value);
    }

    /**
    * Allows custom stylesheets to be included within the editing area. This setting is applicable only when the Editor is initialized from a textarea and a contenteditable iframe is generated.
    * @param array $value
    * @return \Kendo\UI\Editor
    */
    public function stylesheets($value) {
        return $this->setProperty('stylesheets', $value);
    }

    /**
    * Adds EditorTool to the Editor.
    * @param \Kendo\UI\EditorTool|array,... $value one or more EditorTool to add.
    * @return \Kendo\UI\Editor
    */
    public function addTool($value) {
        return $this->add('tools', func_get_args());
    }

    /**
    * Configuration for image browser dialog.
    * @param \Kendo\UI\EditorImageBrowser|array $value
    * @return \Kendo\UI\Editor
    */
    public function imageBrowser($value) {
        return $this->setProperty('imageBrowser', $value);
    }

    /**
    * Configuration for file browser dialog.
    * @param \Kendo\UI\EditorFileBrowser|array $value
    * @return \Kendo\UI\Editor
    */
    public function fileBrowser($value) {
        return $this->setProperty('fileBrowser', $value);
    }

    /**
    * The tag that will be rendered. Defaults to "textarea". Triggers the inline edit mode if different.
    * @param string $value
    * @return \Kendo\UI\Editor
    */
    public function tag($value) {
        return $this->setProperty('tag', $value);
    }

    /**
    * Sets the change event of the Editor.
    * Fires when Editor is blurred and its content has changed.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function change($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('change', $value);
    }

    /**
    * Sets the execute event of the Editor.
    * Fires when an Editor command is executed.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function execute($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('execute', $value);
    }

    /**
    * Sets the keydown event of the Editor.
    * Fires when the user depresses a keyboard key. Triggered multiple times if the user holds the key down.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function keydown($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('keydown', $value);
    }

    /**
    * Sets the keyup event of the Editor.
    * Fires when the user releases a keyboard key.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function keyup($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('keyup', $value);
    }

    /**
    * Sets the paste event of the Editor.
    * Fires before the content is pasted in the Editor.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function paste($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('paste', $value);
    }

    /**
    * Sets the pdfExport event of the Editor.
    * Fired when the user clicks the "Export to PDF" toolbar button.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function pdfExport($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('pdfExport', $value);
    }

    /**
    * Sets the select event of the Editor.
    * Fires when the Editor selection has changed.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\UI\Editor
    */
    public function select($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('select', $value);
    }


    /**
    * Sets the HTML content of the Editor.
    * @param string $value
    * @return \Kendo\UI\Editor
    */
    public function content($value) {
        return $this->setProperty('content', $value);
    }

    /**
    * Starts output bufferring. Any following markup will be set as the content of the Editor.
    */
    public function startContent() {
        ob_start();
    }

    /**
    * Stops output bufferring and sets the preceding markup as the content of the Editor.
    */
    public function endContent() {
        $this->content(ob_get_clean());
    }

//<< Properties
}

?>
