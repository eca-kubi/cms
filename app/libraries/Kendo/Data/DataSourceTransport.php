<?php

namespace Kendo\Data;

class DataSourceTransport extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The object can contain all the available jQuery.ajax options.
    * @param \Kendo\Data\DataSourceTransportBatch|array $value
    * @return \Kendo\Data\DataSourceTransport
    */
    public function batch($value) {
        return $this->setProperty('batch', $value);
    }

    /**
    * Specifies if the transport caches the result from read requests. The query parameters are used as a cache key and if the key is present in the cache, a new request to the server is not executed. The cache is kept in memory and thus cleared on page refresh.
    * @param boolean $value
    * @return \Kendo\Data\DataSourceTransport
    */
    public function cache($value) {
        return $this->setProperty('cache', $value);
    }

    /**
    * The configuration used when the data source saves newly created data items. Those are items added to the data source via the add or insert methods.If the value of transport.create is a function, the data source invokes that function instead of jQuery.ajax. Check the jQuery documentation for more details on the provided argument.If the value of transport.create is a string, the data source uses this string as the URL of the remote service.
    * @param string|\Kendo\JavaScriptFunction|\Kendo\Data\DataSourceTransportCreate|array $value
    * @return \Kendo\Data\DataSourceTransport
    */
    public function create($value) {
        return $this->setProperty('create', $value);
    }

    /**
    * The configuration used when the data source destroys data items. Those are items removed from the data source via the remove method.If the value of transport.destroy is a function, the data source invokes that function instead of jQuery.ajax.If the value of transport.destroy is a string, the data source uses this string as the URL of the remote service.
    * @param string|\Kendo\JavaScriptFunction|\Kendo\Data\DataSourceTransportDestroy|array $value
    * @return \Kendo\Data\DataSourceTransport
    */
    public function destroy($value) {
        return $this->setProperty('destroy', $value);
    }

    /**
    * Sets the parameterMap option of the DataSourceTransport.
    * The function which converts the request parameters to a format suitable for the remote service. By default, the data source sends the parameters using jQuery's conventions.If a transport.read.data function is used together with parameterMap, do not forget to preserve the result from the data function that will be received in the parameterMap arguments. An example is provided below. Generally, the parameterMap function is designed to transform the request payload, not add new parameters to it.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSourceTransport
    */
    public function parameterMap($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('parameterMap', $value);
    }

    /**
    * Sets the push option of the DataSourceTransport.
    * The function invoked during transport initialization which sets up push notifications. The data source will call this function only once and provide callbacks which will handle push notifications (data pushed from the server).
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSourceTransport
    */
    public function push($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('push', $value);
    }

    /**
    * The configuration used when the data source loads data items from a remote service.If the value of transport.read is a function, the data source invokes that function instead of jQuery.ajax.If the value of transport.read is a string, the data source uses this string as the URL of the remote service.
    * @param string|\Kendo\JavaScriptFunction|\Kendo\Data\DataSourceTransportRead|array $value
    * @return \Kendo\Data\DataSourceTransport
    */
    public function read($value) {
        return $this->setProperty('read', $value);
    }

    /**
    * Sets the submit option of the DataSourceTransport.
    * A function that will handle create, update and delete operations in a single batch when custom transport is used, i.e. the transport.read is defined as a function.The transport.create, transport.update and transport.delete operations will not be executed in this case.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSourceTransport
    */
    public function submit($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('submit', $value);
    }

    /**
    * The configuration used when the data source saves updated data items. Those are data items whose fields have been updated.If the value of transport.update is a function, the data source invokes that function instead of jQuery.ajax.If the value of transport.update is a string, the data source uses this string as the URL of the remote service.
    * @param string|\Kendo\JavaScriptFunction|\Kendo\Data\DataSourceTransportUpdate|array $value
    * @return \Kendo\Data\DataSourceTransport
    */
    public function update($value) {
        return $this->setProperty('update', $value);
    }

//<< Properties
}

?>
