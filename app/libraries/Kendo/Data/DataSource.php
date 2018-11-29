<?php

namespace Kendo\Data;

class DataSource extends \Kendo\SerializableObject {
//>> Properties

    /**
    * Adds DataSourceAggregateItem to the DataSource.
    * @param \Kendo\Data\DataSourceAggregateItem|array,... $value one or more DataSourceAggregateItem to add.
    * @return \Kendo\Data\DataSource
    */
    public function addAggregateItem($value) {
        return $this->add('aggregate', func_get_args());
    }

    /**
    * If set to true the data source would automatically save any changed data items by calling the sync method. By default, changes are not automatically saved.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function autoSync($value) {
        return $this->setProperty('autoSync', $value);
    }

    /**
    * If set to true, the data source will batch CRUD operation requests. For example, updating two data items would cause one HTTP request instead of two. By default, the data source makes a HTTP request for every CRUD operation.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function batch($value) {
        return $this->setProperty('batch', $value);
    }

    /**
    * The array of data items which the data source contains. The data source will wrap those items as kendo.data.ObservableObject or kendo.data.Model (if schema.model is set).Can be set to a string value if the schema.type option is set to "xml".
    * @param array|string $value
    * @return \Kendo\Data\DataSource
    */
    public function data($value) {
        return $this->setProperty('data', $value);
    }

    /**
    * Adds DataSourceFilterItem to the DataSource.
    * @param \Kendo\Data\DataSourceFilterItem|array,... $value one or more DataSourceFilterItem to add.
    * @return \Kendo\Data\DataSource
    */
    public function addFilterItem($value) {
        return $this->add('filter', func_get_args());
    }

    /**
    * Adds DataSourceGroupItem to the DataSource.
    * @param \Kendo\Data\DataSourceGroupItem|array,... $value one or more DataSourceGroupItem to add.
    * @return \Kendo\Data\DataSource
    */
    public function addGroupItem($value) {
        return $this->add('group', func_get_args());
    }

    /**
    * If set to true the original Array used as data will be sorted when sorting operation is performed. This setting supported only with local data, bound to a JavaScript array via the data option.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function inPlaceSort($value) {
        return $this->setProperty('inPlaceSort', $value);
    }

    /**
    * The offline storage key or custom offline storage implementation.
    * @param string| $value
    * @return \Kendo\Data\DataSource
    */
    public function offlineStorage($value) {
        return $this->setProperty('offlineStorage', $value);
    }

    /**
    * The page of data which the data source will return when the view method is invoked or request from the remote service.
    * @param float $value
    * @return \Kendo\Data\DataSource
    */
    public function page($value) {
        return $this->setProperty('page', $value);
    }

    /**
    * The number of data items per page. The property has no default value. That is why to use paging, make sure some pageSize value is set.
    * @param float $value
    * @return \Kendo\Data\DataSource
    */
    public function pageSize($value) {
        return $this->setProperty('pageSize', $value);
    }

    /**
    * The configuration used to parse the remote service response.
    * @param \Kendo\Data\DataSourceSchema|array $value
    * @return \Kendo\Data\DataSource
    */
    public function schema($value) {
        return $this->setProperty('schema', $value);
    }

    /**
    * If set to true, the data source will leave the aggregate calculation to the remote service. By default, the data source calculates aggregates client-side.For more information and tips about client and server data operations, refer to the introductory article on the DataSource.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function serverAggregates($value) {
        return $this->setProperty('serverAggregates', $value);
    }

    /**
    * If set to true, the data source will leave the filtering implementation to the remote service. By default, the data source performs filtering client-side.By default, the filter is sent to the server following jQuery's conventions.For example, the filter { logic: "and", filters: [ { field: "name", operator: "startswith", value: "Jane" } ] } is sent as: filter[logic]: and; filter[filters][0][field]: name; filter[filters][0][operator]: startswith or filter[filters][0][value]: Jane. Use the parameterMap option to send the filter option in a different format.For more information and tips about client and server data operations, refer to the introductory article on the DataSource.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function serverFiltering($value) {
        return $this->setProperty('serverFiltering', $value);
    }

    /**
    * If set to true, the data source will leave the grouping implementation to the remote service. By default, the data source performs grouping client-side.By default, the group is sent to the server following jQuery's conventions.For example, the group { field: "category", dir: "desc" } is sent as: group[0][field]: category or group[0][dir]: desc. Use the parameterMap option to send the group option in a different format.For more information and tips about client and server data operations, refer to the introductory article on the DataSource.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function serverGrouping($value) {
        return $this->setProperty('serverGrouping', $value);
    }

    /**
    * If set to true, the data source will leave the data item paging implementation to the remote service. By default, the data source performs paging client-side.The following options are sent to the server when server paging is enabled: page - the page of data item to return (1 means the first page).; pageSize - the number of items to return.; skip - how many data items to skip. or take - the number of data items to return (the same as pageSize).. Use the parameterMap option to send the paging options in a different format.For more information and tips about client and server data operations, refer to the introductory article on the DataSource.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function serverPaging($value) {
        return $this->setProperty('serverPaging', $value);
    }

    /**
    * If set to true, the data source will leave the data item sorting implementation to the remote service. By default, the data source performs sorting client-side.By default, the sort is sent to the server following jQuery's conventions.For example, the sort { field: "age", dir: "desc" } is sent as: sort[0][field]: age or sort[0][dir]: desc. Use the parameterMap option to send the paging options in a different format.For more information and tips about client and server data operations, refer to the introductory article on the DataSource.
    * @param boolean $value
    * @return \Kendo\Data\DataSource
    */
    public function serverSorting($value) {
        return $this->setProperty('serverSorting', $value);
    }

    /**
    * Adds DataSourceSortItem to the DataSource.
    * @param \Kendo\Data\DataSourceSortItem|array,... $value one or more DataSourceSortItem to add.
    * @return \Kendo\Data\DataSource
    */
    public function addSortItem($value) {
        return $this->add('sort', func_get_args());
    }

    /**
    * The configuration used to load and save the data items. A data source is remote or local based on the way it retrieves data items.Remote data sources load and save data items from and to a remote end-point (also known as remote service or server). The transport option describes the remote service configuration - URL, HTTP verb, HTTP headers, and others. The transport option can also be used to implement custom data loading and saving.Local data sources are bound to a JavaScript array via the data option.
    * @param \Kendo\Data\DataSourceTransport|array $value
    * @return \Kendo\Data\DataSource
    */
    public function transport($value) {
        return $this->setProperty('transport', $value);
    }

    /**
    * If set, the data source will use a predefined transport and/or schema.The supported values are: "odata" which supports the OData v.2 protocol; "odata-v4" which partially supports odata version 4 or "signalr".
    * @param string $value
    * @return \Kendo\Data\DataSource
    */
    public function type($value) {
        return $this->setProperty('type', $value);
    }

    /**
    * Sets the change event of the DataSource.
    * Fired when the data source is populated from a JavaScript array or a remote service, a data item is inserted, updated or removed, the data items are paged, sorted, filtered, or grouped.The event handler function context (available via the this keyword) will be set to the data source instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSource
    */
    public function change($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('change', $value);
    }

    /**
    * Sets the error event of the DataSource.
    * Fired when a request to the remote service fails.The event handler function context (available via the this keyword) will be set to the data source instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSource
    */
    public function error($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('error', $value);
    }

    /**
    * Sets the push event of the DataSource.
    * Fired when the data source receives a push notification or the pushCreate, pushUpdate, or pushDestroy methods are called.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSource
    */
    public function push($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('push', $value);
    }

    /**
    * Sets the requestEnd event of the DataSource.
    * Fired when a remote service request is finished.The event handler function context (available via the this keyword) will be set to the data source instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSource
    */
    public function requestEnd($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('requestEnd', $value);
    }

    /**
    * Sets the requestStart event of the DataSource.
    * Fired when the data source makes a remote service request.The event handler function context (available via the this keyword) will be set to the data source instance.It is possible to prevent the remote request. To achieve this, execute e.preventDefault() in the handler function.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSource
    */
    public function requestStart($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('requestStart', $value);
    }

    /**
    * Sets the sync event of the DataSource.
    * Fired after the data source saves data item changes. The data source saves the data item changes when the sync method is called.The event handler function context (available via the this keyword) will be set to the data source instance.
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Data\DataSource
    */
    public function sync($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('sync', $value);
    }


//<< Properties
}

?>
