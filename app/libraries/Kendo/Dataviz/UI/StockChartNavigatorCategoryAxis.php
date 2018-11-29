<?php

namespace Kendo\Dataviz\UI;

class StockChartNavigatorCategoryAxis extends \Kendo\SerializableObject {
//>> Properties

    /**
    * The discrete navigator.categoryAxis.baseUnitStep values when either navigator.categoryAxis.baseUnit is set to "fit" ornavigator.categoryAxis.baseUnitStep is set to "auto".
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisAutoBaseUnitSteps|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function autoBaseUnitSteps($value) {
        return $this->setProperty('autoBaseUnitSteps', $value);
    }

    /**
    * Category index at which the first value axis crosses this axis (when set as an object).Category indices at which the value axes cross the category axis (when set as an array).
    * @param |date|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function axisCrossingValue($value) {
        return $this->setProperty('axisCrossingValue', $value);
    }

    /**
    * The background color of the axis.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function background($value) {
        return $this->setProperty('background', $value);
    }

    /**
    * The base time interval for the date axis. The default base unit is determined automatically from the minimum difference between subsequent categories.The supported values are: "fit"; "seconds"; "minutes"; "hours"; "days"; "weeks"; "months" or "years". Setting baseUnit to "fit" will set such base unit and categoryAxis.baseUnitStep that the total number of categories does not exceed categoryAxis.maxDateGroups.Series data is aggregated for the specified base unit using the series.aggregate function.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function baseUnit($value) {
        return $this->setProperty('baseUnit', $value);
    }

    /**
    * The step (interval) between categories in base units. Setting it to "auto" will set the step to such value that the total number of categories does not exceed categoryAxis.maxDateGroups.This option is ignored if categoryAxis.baseUnit is set to "fit".
    * @param  $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function baseUnitStep($value) {
        return $this->setProperty('baseUnitStep', $value);
    }

    /**
    * The category names. The chart will create a category for every item of the array.
    * @param array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function categories($value) {
        return $this->setProperty('categories', $value);
    }

    /**
    * The color to apply to all axis elements. Accepts a valid CSS color string, including hex and rgb. Can be overridden by categoryAxis.labels.color andcategoryAxis.line.color.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function color($value) {
        return $this->setProperty('color', $value);
    }

    /**
    * The crosshair configuration options.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisCrosshair|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function crosshair($value) {
        return $this->setProperty('crosshair', $value);
    }

    /**
    * The data item field which contains the category name. Requires the dataSource option to be set.
    * @param string $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function field($value) {
        return $this->setProperty('field', $value);
    }

    /**
    * If set to true the chart will position categories and series points on major ticks. This removes the empty space before and after the series.The default value is false except for "area" and "verticalArea".
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function justified($value) {
        return $this->setProperty('justified', $value);
    }

    /**
    * The axis labels configuration.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisLabels|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function labels($value) {
        return $this->setProperty('labels', $value);
    }

    /**
    * The configuration of the axis lines. Also affects the major and minor ticks, but not the grid lines.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisLine|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function line($value) {
        return $this->setProperty('line', $value);
    }

    /**
    * The configuration of the major grid lines. These are the lines that are an extension of the major ticks through the body of the chart.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisMajorGridLines|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function majorGridLines($value) {
        return $this->setProperty('majorGridLines', $value);
    }

    /**
    * The configuration of the category axis major ticks.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisMajorTicks|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function majorTicks($value) {
        return $this->setProperty('majorTicks', $value);
    }

    /**
    * The last date displayed on the category date axis. By default, the minimum date is the same as the last category. This is often used in combination with the categoryAxis.min and categoryAxis.roundToBaseUnit options to set up a fixed date range.
    * @param  $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function max($value) {
        return $this->setProperty('max', $value);
    }

    /**
    * The maximum number of groups (categories) to display whencategoryAxis.baseUnit is set to "fit" orcategoryAxis.baseUnitStep is set to "auto".
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function maxDateGroups($value) {
        return $this->setProperty('maxDateGroups', $value);
    }

    /**
    * The first date displayed on the category date axis. By default, the minimum date is the same as the first category. This is often used in combination with the categoryAxis.min and categoryAxis.roundToBaseUnit options to set up a fixed date range.
    * @param  $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function min($value) {
        return $this->setProperty('min', $value);
    }

    /**
    * The configuration of the minor grid lines. These are the lines that are an extension of the minor ticks through the body of the chart.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisMinorGridLines|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function minorGridLines($value) {
        return $this->setProperty('minorGridLines', $value);
    }

    /**
    * The configuration of the category axis minor ticks.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisMinorTicks|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function minorTicks($value) {
        return $this->setProperty('minorTicks', $value);
    }

    /**
    * Adds StockChartNavigatorCategoryAxisPlotBand to the StockChartNavigatorCategoryAxis.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisPlotBand|array,... $value one or more StockChartNavigatorCategoryAxisPlotBand to add.
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function addPlotBand($value) {
        return $this->add('plotBands', func_get_args());
    }

    /**
    * If set to true the category axis direction will be reversed. By default categories are listed from left to right and from bottom to top.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function reverse($value) {
        return $this->setProperty('reverse', $value);
    }

    /**
    * If set to true the chart will round the first and last date to the nearest base unit.The roundToBaseUnit option will be ignored if series.type is set to "bar", "column", "ohlc" or "candlestick".
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function roundToBaseUnit($value) {
        return $this->setProperty('roundToBaseUnit', $value);
    }

    /**
    * The title configuration of the category axis.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisTitle|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function title($value) {
        return $this->setProperty('title', $value);
    }

    /**
    * If set to true the chart will display the category axis. By default the category axis is visible.
    * @param boolean $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function visible($value) {
        return $this->setProperty('visible', $value);
    }

    /**
    * The week start day when categoryAxis.baseUnit is set to "weeks".The supported values are: kendo.days.Sunday - equal to 0; kendo.days.Monday - equal to 1; kendo.days.Tuesday - equal to 2; kendo.days.Wednesday - equal to 3; kendo.days.Thursday - equal to 4; kendo.days.Friday - equal to 5 or kendo.days.Saturday - equal to 6.
    * @param float $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function weekStartDay($value) {
        return $this->setProperty('weekStartDay', $value);
    }

    /**
    * The category axis notes configuration.
    * @param \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxisNotes|array $value
    * @return \Kendo\Dataviz\UI\StockChartNavigatorCategoryAxis
    */
    public function notes($value) {
        return $this->setProperty('notes', $value);
    }

//<< Properties
}

?>
