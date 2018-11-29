<?php

namespace Kendo\Dataviz\UI;

class StockChartSeriesItem extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The type of the series. Available types: area; column; line; candlestick, ohlc or bullet.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function type($value) {
        return $this->setProperty('type', $value);
    }

    /**
    * The series line dash type.** Applicable only to line series **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function dashType($value) {
        return $this->setProperty('dashType', $value);
    }

    /**
    * Array of data items. The data item type can be either a: Array of objects. Each point is bound to the specified series fields.; Array of numbers. Available for area, column and line series. or Array of arrays of numbers. Available for:OHLC and candlestick series (open, high, low, close).
    * @param array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function data($value) {
        return $this->setProperty('data', $value);
    }

    /**
    * The data field containing the high value.** Available for candlestick and ohlc series only **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function highField($value) {
        return $this->setProperty('highField', $value);
    }

    /**
    * The data field containing the series value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function field($value) {
        return $this->setProperty('field', $value);
    }

    /**
    * The data item field which contains the category name or date.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function categoryField($value) {
        return $this->setProperty('categoryField', $value);
    }

    /**
    * The data field containing the current value.** Available for bullet and verticalBullet series. **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function currentField($value) {
        return $this->setProperty('currentField', $value);
    }

    /**
    * The data field containing the target value.** Available for bullet and verticalBullet series. **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function targetField($value) {
        return $this->setProperty('targetField', $value);
    }

    /**
    * The series name visible in the legend.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function name($value) {
        return $this->setProperty('name', $value);
    }

    /**
    * Configures the appearance of highlighted points.
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemHighlight|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function highlight($value) {
        return $this->setProperty('highlight', $value);
    }

    /**
    * The aggregate function to apply for date series.This function is used when a category (an year, month, etc.) contains two or more points. The function return value is displayed instead of the individual points.The supported values are: "avg" - the average of all values for the date period.; "count" - the number of values for the date period.; "max" - the highest value for the date period.; "min" - the lowest value for the date period.; "sum" - the sum of all values for the date period. Defaults to 0 if no data points are defined.; "sumOrNull" - the sum of all values for the date period. Defaults to null if no data points are defined.; "first" - the first value; function(values, series, dataItems, category) - user-defined aggregate function. Returns single value or data item. or object  - (compound aggregate) Applicable to "candlestick" and ohlc "series". Specifies the aggregate for each data item field..
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function aggregate($value) {
        return $this->setProperty('aggregate', $value);
    }

    /**
    * The name of the value axis to use.** Applicable to area, column, line, ohlc and candlestick series **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function axis($value) {
        return $this->setProperty('axis', $value);
    }

    /**
    * The border of the points.** Applicable to column, ohlc and candlestick series **
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemBorder|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The data field containing the close value.** Available for candlestick and ohlc series only **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function closeField($value) {
        return $this->setProperty('closeField', $value);
    }

    /**
    * The series base color. The supported values are: CSS color string, including hex and rgb or function(point) - user-defined function that will be evaluated for each point. Returning undefined will assume the default series color..
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The data field containing the point color.** Applicable for column, candlestick and ohlc series. **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function colorField($value) {
        return $this->setProperty('colorField', $value);
    }

    /**
    * The series color when the open value is greater than the close value.** Available for candlestick series only **
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function downColor($value) {
        return $this->setProperty('downColor', $value);
    }

    /**
    * The data field containing the color applied when the open value is greater than the close value.** Available for candlestick series only **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function downColorField($value) {
        return $this->setProperty('downColorField', $value);
    }

    /**
    * The distance between category clusters.** Applicable for column, candlestick and ohlc series. **
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function gap($value) {
        return $this->setProperty('gap', $value);
    }

    /**
    * Configures the series data labels.
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemLabels|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function labels($value) {
        return $this->setProperty('labels', $value);
    }

    /**
    * Line options.** Applicable to area, candlestick and ohlc series. **
    * @param string|\Kendo\Dataviz\UI\StockChartSeriesItemLine|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function line($value) {
        return $this->setProperty('line', $value);
    }

    /**
    * The data field containing the low value.** Available for candlestick and ohlc series **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function lowField($value) {
        return $this->setProperty('lowField', $value);
    }

    /**
    * Marker options.** Applicable for area and line series. **
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemMarkers|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function markers($value) {
        return $this->setProperty('markers', $value);
    }

    /**
    * The behavior for handling missing values. The supported values are: "gap" - the plot stops before the missing point and continues after it.; "interpolate" - the value is interpolated from neighboring points. or "zero" - the value is assumed to be zero..
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function missingValues($value) {
        return $this->setProperty('missingValues', $value);
    }

    /**
    * The supported values are: "normal" - The values will be connected with straight line.; "step" - The values will be connected with a line at right. or "smooth" - The values will be connected with a smooth line..
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function style($value) {
        return $this->setProperty('style', $value);
    }

    /**
    * Color to use for bars with negative values.** Applicable only to column series. **The plot stops before the missing point and continues after it.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function negativeColor($value) {
        return $this->setProperty('negativeColor', $value);
    }

    /**
    * The series opacity.
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function opacity($value) {
        return $this->setProperty('opacity', $value);
    }

    /**
    * The data field containing the open value.** Available for candlestick and ohlc series **
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function openField($value) {
        return $this->setProperty('openField', $value);
    }

    /**
    * The effects overlay.
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemOverlay|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function overlay($value) {
        return $this->setProperty('overlay', $value);
    }

    /**
    * Space between points as proportion of the point width.Available for column, candlestick and ohlc series.
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function spacing($value) {
        return $this->setProperty('spacing', $value);
    }

    /**
    * A boolean value indicating if the series should be stacked. A string value is interpreted as series.stack.group.
    * @param boolean|string|\Kendo\Dataviz\UI\StockChartSeriesItemStack|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function stack($value) {
        return $this->setProperty('stack', $value);
    }

    /**
    * The data point tooltip configuration options.
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemTooltip|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function tooltip($value) {
        return $this->setProperty('tooltip', $value);
    }

    /**
    * A value indicating whether to show the series name in the legend.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function visibleInLegend($value) {
        return $this->setProperty('visibleInLegend', $value);
    }

    /**
    * The line width.** Applicable for area and line series. **
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function width($value) {
        return $this->setProperty('width', $value);
    }

    /**
    * The target of the bullet chart.
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemTarget|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function target($value) {
        return $this->setProperty('target', $value);
    }

    /**
    * The series notes configuration.
    * @param \Kendo\Dataviz\UI\StockChartSeriesItemNotes|array $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function notes($value) {
        return $this->setProperty('notes', $value);
    }

    /**
    * An optional Z-index that can be used to change the default stacking order of series.The series with the highest Z-index will be placed on top.Series with no Z-index will use the default stacking order based on series type. For example line series will be on top with bar and area following below.
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartSeriesItem
    */
    public function zIndex($value) {
        return $this->setProperty('zIndex', $value);
    }

//<< Properties
}

?>
