<?php

namespace Kendo\Dataviz\UI;

class ChartSeriesItem extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The aggregate function to apply for date series.This function is used when a category (an year, month, etc.) contains two or more points. The function return value is displayed instead of the individual points.The supported values are: "avg" - the average of all values for the date period.; "count" - the number of values for the date period.; "max" - the highest value for the date period.; "min" - the lowest value for the date period.; "sum" - the sum of all values for the date period. Defaults to 0 if no data points are defined.; "sumOrNull" - the sum of all values for the date period. Defaults to null if no data points are defined.; "first" - the first value; function(values, series, dataItems, category) - user-defined aggregate function. Returns single value or data item. or object  - (compound aggregate) Applicable to "candlestick", "boxPlot"  and ohlc "series". Specifies the aggregate for each data item field..
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function aggregate($value) {
        return $this->setProperty('aggregate', $value);
    }

    /**
    * The name of the value axis to use.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function axis($value) {
        return $this->setProperty('axis', $value);
    }

    /**
    * The border of the chart series.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemBorder|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function border($value) {
        return $this->setProperty('border', $value);
    }

    /**
    * The name of the category axis to use for the series.The first axis will be used if no categoryAxis is specified.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function categoryAxis($value) {
        return $this->setProperty('categoryAxis', $value);
    }

    /**
    * The data item field which contains the category name or date.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function categoryField($value) {
        return $this->setProperty('categoryField', $value);
    }

    /**
    * The data field containing the close value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function closeField($value) {
        return $this->setProperty('closeField', $value);
    }

    /**
    * The series base color. The supported values are: CSS color string, including hex and rgb or function(point) - user-defined function that will be evaluated for each point. Returning undefined will assume the default series color..
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The data item field which contains the series color.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function colorField($value) {
        return $this->setProperty('colorField', $value);
    }

    /**
    * The label connectors options.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemConnectors|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function connectors($value) {
        return $this->setProperty('connectors', $value);
    }

    /**
    * The data item field containing the current value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function currentField($value) {
        return $this->setProperty('currentField', $value);
    }

    /**
    * The dash type of line chart.The following dash types are supported: "dash" - a line consisting of dashes; "dashDot" - a line consisting of a repeating pattern of dash-dot; "dot" - a line consisting of dots; "longDash" - a line consisting of a repeating pattern of long-dash; "longDashDot" - a line consisting of a repeating pattern of long-dash-dot; "longDashDotDot" - a line consisting of a repeating pattern of long-dash-dot-dot or "solid" - a solid line.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function dashType($value) {
        return $this->setProperty('dashType', $value);
    }

    /**
    * The array of data items which represent the series data.Can be set to : Array of objects. Each point is bound to the field specified via the series.field option.; Array of numbers. Supported when the series.type option is set to "area", "bar", "column", "donut", "pie", "line" or "waterfall". or Array of arrays of numbers. Supported when the series.type option is set to "bubble", "scatter", "scatterLine", "ohlc", "rangeBar", "rangeArea" or polar series.Bubble series need arrays of three values - X value, Y value and Size value e.g. [1, 1, 10]Scatter and scatter line series need arrays of two values - X value and Y valueOHLC and candlestick series need arrays of four values - open, high, low and closeRangeBar and RangeArea series need arrays of two values - the from and to value..
    * @param array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function data($value) {
        return $this->setProperty('data', $value);
    }

    /**
    * The series color when the open value is greater than the close value.
    * @param string|\Kendo\JavaScriptFunction $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function downColor($value) {
        return $this->setProperty('downColor', $value);
    }

    /**
    * The data field containing the color applied when the open value is greater than the close value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function downColorField($value) {
        return $this->setProperty('downColorField', $value);
    }

    /**
    * The space in pixels between the different segments of the funnel chart.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function segmentSpacing($value) {
        return $this->setProperty('segmentSpacing', $value);
    }

    /**
    * The data item field which contains the summary type for waterfall series. Summary columns are optional and can be one of two types: "runningTotal" - Displays the sum of all items since the last "runningTotal" point. or "total" - Displays the sum of all previous items..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function summaryField($value) {
        return $this->setProperty('summaryField', $value);
    }

    /**
    * specifies the ratio top-base/bottom-base of the whole chart. neckRatio set to three means the top base is three times smaller than the bottom base.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function neckRatio($value) {
        return $this->setProperty('neckRatio', $value);
    }

    /**
    * When set to true the ratio of the bases of each segment is calculated based on the ratio of currentDataItem.value/nextDataItem.value The last element is always created like a rectangle since there is no following element.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function dynamicSlope($value) {
        return $this->setProperty('dynamicSlope', $value);
    }

    /**
    * When set to false all segments become with the same height, otherwise the height of each segment is based on its value.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function dynamicHeight($value) {
        return $this->setProperty('dynamicHeight', $value);
    }

    /**
    * The error bars of the chart series.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemErrorBars|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function errorBars($value) {
        return $this->setProperty('errorBars', $value);
    }

    /**
    * The data item field which contains the series.errorBars low value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function errorLowField($value) {
        return $this->setProperty('errorLowField', $value);
    }

    /**
    * The data item field which contains the series.errorBars high value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function errorHighField($value) {
        return $this->setProperty('errorHighField', $value);
    }

    /**
    * The data item field which contains the series.errorBars xAxis low value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function xErrorLowField($value) {
        return $this->setProperty('xErrorLowField', $value);
    }

    /**
    * The data item field which contains the series.errorBars xAxis high value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function xErrorHighField($value) {
        return $this->setProperty('xErrorHighField', $value);
    }

    /**
    * The data item field which contains the series.errorBars yAxis low value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function yErrorLowField($value) {
        return $this->setProperty('yErrorLowField', $value);
    }

    /**
    * The data item field which contains the series.errorBars yAxis high value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function yErrorHighField($value) {
        return $this->setProperty('yErrorHighField', $value);
    }

    /**
    * The data item field which contains a boolean value indicating whether the sector is exploded.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function explodeField($value) {
        return $this->setProperty('explodeField', $value);
    }

    /**
    * The data item field which contains the series value. The field name should be a valid Javascript identifier and should contain only alphanumeric characters (or "$" or "_"), and may not start with a digit.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function field($value) {
        return $this->setProperty('field', $value);
    }

    /**
    * The data item field which contains the series from value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function fromField($value) {
        return $this->setProperty('fromField', $value);
    }

    /**
    * The data item field which contains the series to value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function toField($value) {
        return $this->setProperty('toField', $value);
    }

    /**
    * The data item field which contains the series note text.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function noteTextField($value) {
        return $this->setProperty('noteTextField', $value);
    }

    /**
    * The data item field which contains the series lower value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function lowerField($value) {
        return $this->setProperty('lowerField', $value);
    }

    /**
    * The data item field which contains the series q1 value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function q1Field($value) {
        return $this->setProperty('q1Field', $value);
    }

    /**
    * The data item field which contains the series median value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function medianField($value) {
        return $this->setProperty('medianField', $value);
    }

    /**
    * The data item field which contains the series q3 value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function q3Field($value) {
        return $this->setProperty('q3Field', $value);
    }

    /**
    * The data item field which contains the series upper value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function upperField($value) {
        return $this->setProperty('upperField', $value);
    }

    /**
    * The data item field which contains the series mean value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function meanField($value) {
        return $this->setProperty('meanField', $value);
    }

    /**
    * The data item field which contains the series outliers value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function outliersField($value) {
        return $this->setProperty('outliersField', $value);
    }

    /**
    * The distance between categories expressed as a percentage of the bar width.See the related spacing setting.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function gap($value) {
        return $this->setProperty('gap', $value);
    }

    /**
    * The data field containing the high value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function highField($value) {
        return $this->setProperty('highField', $value);
    }

    /**
    * The chart series highlighting configuration options.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemHighlight|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function highlight($value) {
        return $this->setProperty('highlight', $value);
    }

    /**
    * The diameter of the donut hole in pixels.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function holeSize($value) {
        return $this->setProperty('holeSize', $value);
    }

    /**
    * The chart series label configuration.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemLabels|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function labels($value) {
        return $this->setProperty('labels', $value);
    }

    /**
    * The chart line configuration options.
    * @param string|\Kendo\Dataviz\UI\ChartSeriesItemLine|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function line($value) {
        return $this->setProperty('line', $value);
    }

    /**
    * The data field containing the low value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function lowField($value) {
        return $this->setProperty('lowField', $value);
    }

    /**
    * The margin around each donut series (ring). A numeric value will set all margins.
    * @param float| $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function margin($value) {
        return $this->setProperty('margin', $value);
    }

    /**
    * The chart series marker configuration.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemMarkers|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function markers($value) {
        return $this->setProperty('markers', $value);
    }

    /**
    * The chart series outliers configuration. Applies to mild outliers. Also check series.extremes.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemOutliers|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function outliers($value) {
        return $this->setProperty('outliers', $value);
    }

    /**
    * The chart series extremes configuration. Applies to extreme outliers. Also check series.outliers.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemExtremes|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function extremes($value) {
        return $this->setProperty('extremes', $value);
    }

    /**
    * The maximum size of the chart bubble series marker.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function maxSize($value) {
        return $this->setProperty('maxSize', $value);
    }

    /**
    * The minimum size of the chart bubble series marker.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function minSize($value) {
        return $this->setProperty('minSize', $value);
    }

    /**
    * The behavior for handling missing values. The supported values are: "gap" - the plot stops before the missing point and continues after it.; "interpolate" - the value is interpolated from neighboring points. or "zero" - the value is assumed to be zero..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function missingValues($value) {
        return $this->setProperty('missingValues', $value);
    }

    /**
    * The supported values are: "normal" - The values will be connected with straight line.; "step" - The values will be connected with a line with right angle. or "smooth" - The values will be connected with a smooth line..
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function style($value) {
        return $this->setProperty('style', $value);
    }

    /**
    * The name of the chart series which is visible in the legend.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function name($value) {
        return $this->setProperty('name', $value);
    }

    /**
    * The color to use for bar, column or waterfall series with negative values. Accepts a valid CSS color string, including hex and rgb.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function negativeColor($value) {
        return $this->setProperty('negativeColor', $value);
    }

    /**
    * The options for displaying the chart negative bubble values.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemNegativeValues|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function negativeValues($value) {
        return $this->setProperty('negativeValues', $value);
    }

    /**
    * The series opacity. By default the series are opaque.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function opacity($value) {
        return $this->setProperty('opacity', $value);
    }

    /**
    * The data field containing the open value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function openField($value) {
        return $this->setProperty('openField', $value);
    }

    /**
    * The chart series overlay options.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemOverlay|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function overlay($value) {
        return $this->setProperty('overlay', $value);
    }

    /**
    * The padding around the chart (equal on all sides).
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function padding($value) {
        return $this->setProperty('padding', $value);
    }

    /**
    * The or radius of the chart donut series in pixels. If not set, the available space is split evenly between the series.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function size($value) {
        return $this->setProperty('size', $value);
    }

    /**
    * The data field containing the bubble size value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function sizeField($value) {
        return $this->setProperty('sizeField', $value);
    }

    /**
    * The distance between series points within a category. Expressed as a percentage of the bar width.See the related gap setting.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function spacing($value) {
        return $this->setProperty('spacing', $value);
    }

    /**
    * A boolean value indicating if the series should be stacked. A string value is interpreted as series.stack.group.
    * @param boolean|string|\Kendo\Dataviz\UI\ChartSeriesItemStack|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function stack($value) {
        return $this->setProperty('stack', $value);
    }

    /**
    * The start angle (degrees) of the first donut or pie segment.Angles increase clockwise and zero is to the left. Negative values are acceptable.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function startAngle($value) {
        return $this->setProperty('startAngle', $value);
    }

    /**
    * The configuration options of the target
    * @param \Kendo\Dataviz\UI\ChartSeriesItemTarget|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function target($value) {
        return $this->setProperty('target', $value);
    }

    /**
    * The data item field containing the target value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function targetField($value) {
        return $this->setProperty('targetField', $value);
    }

    /**
    * The chart series tooltip configuration options.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemTooltip|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function tooltip($value) {
        return $this->setProperty('tooltip', $value);
    }

    /**
    * The type of the series.The supported values are: area; bar; bubble; bullet; candlestick; column; donut; funnel; horizontalWaterfall; line; ohlc; pie; polarArea; polarLine; polarScatter; radarArea; radarColumn; radarLine; rangeArea; rangeBar; rangeColumn; scatter; scatterLine; verticalArea; verticalBoxPlot; verticalBullet; verticalLine; verticalRangeArea or waterfall.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function type($value) {
        return $this->setProperty('type', $value);
    }

    /**
    * Sets the visible property of a chart series
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

    /**
    * A value indicating whether to show the point category name (for funnel, donut and pie series) or series name (for other available series types) in the legend.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function visibleInLegend($value) {
        return $this->setProperty('visibleInLegend', $value);
    }

    /**
    * The data item field which indicates whether to show the point category name in the legend.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function visibleInLegendField($value) {
        return $this->setProperty('visibleInLegendField', $value);
    }

    /**
    * Sets the visual option of the ChartSeriesItem.
    * A function that can be used to create a custom visual for the points. Applicable for bar, column, pie, donut, funnel, line, scatterLine, rangeBar, rangeColumn and waterfall series. The available argument fields are: rect - the kendo.geometry.Rect that defines where the visual should be rendered.; options - the point options.; createVisual - a function that can be used to get the default visual.; category - the point category.; dataItem - the point dataItem.; value - the point value.; stackValue - the cumulative point value on the stack. Available only for stackable series.; sender - the chart instance.; series - the point series.; percentage - the point value represented as a percentage value. Available only for donut, pie and 100% stacked charts.; runningTotal - the sum of point values since the last "runningTotal" summary point. Available for waterfall series.; total - the sum of all previous series values. Available for waterfall series.; radius - the segment radius. Available for donut and pie series.; innerRadius - the segment inner radius. Available for donut series.; startAngle - the segment start angle. Available for donut and pie series.; endAngle - the segment end angle. Available for donut and pie series.; center - the segment center point. Available for donut and pie series. or points - the segment points. Available for funnel, line and scatterLine series..
    * @param string|\Kendo\JavaScriptFunction $value Can be a JavaScript function definition or name.
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function visual($value) {
        if (is_string($value)) {
            $value = new \Kendo\JavaScriptFunction($value);
        }

        return $this->setProperty('visual', $value);
    }

    /**
    * The line width.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function width($value) {
        return $this->setProperty('width', $value);
    }

    /**
    * The name of the X axis to use.For polar series the xAxis range is expressed in degrees.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function xAxis($value) {
        return $this->setProperty('xAxis', $value);
    }

    /**
    * The data item field containing the X value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function xField($value) {
        return $this->setProperty('xField', $value);
    }

    /**
    * The name of the Y axis to use.** Available for bubble, scatter, scatterLine and polar series. **
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function yAxis($value) {
        return $this->setProperty('yAxis', $value);
    }

    /**
    * The data item field containing the Y value.
    * @param string $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function yField($value) {
        return $this->setProperty('yField', $value);
    }

    /**
    * The series notes configuration.
    * @param \Kendo\Dataviz\UI\ChartSeriesItemNotes|array $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function notes($value) {
        return $this->setProperty('notes', $value);
    }

    /**
    * An optional Z-index that can be used to change the default stacking order of series.The series with the highest Z-index will be placed on top.Series with no Z-index will use the default stacking order based on series type. For example line series will be on top with bar and area following below.
    * @param float $value
    * @return \Kendo\Dataviz\UI\ChartSeriesItem
    */
    public function zIndex($value) {
        return $this->setProperty('zIndex', $value);
    }

//<< Properties
}

?>
