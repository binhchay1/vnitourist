<?php

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
namespace ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData;

class RunPivotReportRequest extends \ahrefs\AhrefsSeo_Vendor\Google\Collection
{
    protected $collection_key = 'pivots';
    protected $cohortSpecType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\CohortSpec::class;
    protected $cohortSpecDataType = '';
    /**
     * @var string
     */
    public $currencyCode;
    protected $dateRangesType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\DateRange::class;
    protected $dateRangesDataType = 'array';
    protected $dimensionFilterType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\FilterExpression::class;
    protected $dimensionFilterDataType = '';
    protected $dimensionsType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\Dimension::class;
    protected $dimensionsDataType = 'array';
    /**
     * @var bool
     */
    public $keepEmptyRows;
    protected $metricFilterType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\FilterExpression::class;
    protected $metricFilterDataType = '';
    protected $metricsType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\Metric::class;
    protected $metricsDataType = 'array';
    protected $pivotsType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\Pivot::class;
    protected $pivotsDataType = 'array';
    /**
     * @var string
     */
    public $property;
    /**
     * @var bool
     */
    public $returnPropertyQuota;
    /**
     * @param CohortSpec
     */
    public function setCohortSpec(\ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\CohortSpec $cohortSpec)
    {
        $this->cohortSpec = $cohortSpec;
    }
    /**
     * @return CohortSpec
     */
    public function getCohortSpec()
    {
        return $this->cohortSpec;
    }
    /**
     * @param string
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;
    }
    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }
    /**
     * @param DateRange[]
     */
    public function setDateRanges($dateRanges)
    {
        $this->dateRanges = $dateRanges;
    }
    /**
     * @return DateRange[]
     */
    public function getDateRanges()
    {
        return $this->dateRanges;
    }
    /**
     * @param FilterExpression
     */
    public function setDimensionFilter(\ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\FilterExpression $dimensionFilter)
    {
        $this->dimensionFilter = $dimensionFilter;
    }
    /**
     * @return FilterExpression
     */
    public function getDimensionFilter()
    {
        return $this->dimensionFilter;
    }
    /**
     * @param Dimension[]
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }
    /**
     * @return Dimension[]
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }
    /**
     * @param bool
     */
    public function setKeepEmptyRows($keepEmptyRows)
    {
        $this->keepEmptyRows = $keepEmptyRows;
    }
    /**
     * @return bool
     */
    public function getKeepEmptyRows()
    {
        return $this->keepEmptyRows;
    }
    /**
     * @param FilterExpression
     */
    public function setMetricFilter(\ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\FilterExpression $metricFilter)
    {
        $this->metricFilter = $metricFilter;
    }
    /**
     * @return FilterExpression
     */
    public function getMetricFilter()
    {
        return $this->metricFilter;
    }
    /**
     * @param Metric[]
     */
    public function setMetrics($metrics)
    {
        $this->metrics = $metrics;
    }
    /**
     * @return Metric[]
     */
    public function getMetrics()
    {
        return $this->metrics;
    }
    /**
     * @param Pivot[]
     */
    public function setPivots($pivots)
    {
        $this->pivots = $pivots;
    }
    /**
     * @return Pivot[]
     */
    public function getPivots()
    {
        return $this->pivots;
    }
    /**
     * @param string
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }
    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }
    /**
     * @param bool
     */
    public function setReturnPropertyQuota($returnPropertyQuota)
    {
        $this->returnPropertyQuota = $returnPropertyQuota;
    }
    /**
     * @return bool
     */
    public function getReturnPropertyQuota()
    {
        return $this->returnPropertyQuota;
    }
}
// Adding a class alias for backwards compatibility with the previous class name.
\class_alias(\ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsData\RunPivotReportRequest::class, 'ahrefs\\AhrefsSeo_Vendor\\Google_Service_AnalyticsData_RunPivotReportRequest');
