<?php

namespace Kendo\UI;

class PivotGridExcel extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Specifies the file name of the exported Excel file.
    * @param string $value
    * @return \Kendo\UI\PivotGridExcel
    */
    public function fileName($value) {
        return $this->setProperty('fileName', $value);
    }

    /**
    * Enables or disables column filtering in the Excel file. Not to be mistaken with the pivotgrid filtering feature.
    * @param boolean $value
    * @return \Kendo\UI\PivotGridExcel
    */
    public function filterable($value) {
        return $this->setProperty('filterable', $value);
    }

    /**
    * If set to true, the content will be forwarded to proxyURL even if the browser supports saving files locally.
    * @param boolean $value
    * @return \Kendo\UI\PivotGridExcel
    */
    public function forceProxy($value) {
        return $this->setProperty('forceProxy', $value);
    }

    /**
    * The URL of the server side proxy which will stream the file to the end user.Such browsers are IE version 9 and lower and Safari.The developer is responsible for implementing the server-side proxy.The proxy will receive a POST request with the following parameters in the request body: contentType: The MIME type of the file; base64: The base-64 encoded file content or fileName: The file name, as requested by the caller.. The proxy should return the decoded file with the "Content-Disposition" header set toattachment; filename="<fileName.xslx>".
    * @param string $value
    * @return \Kendo\UI\PivotGridExcel
    */
    public function proxyURL($value) {
        return $this->setProperty('proxyURL', $value);
    }

//<< Properties
}

?>
