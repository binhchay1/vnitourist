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
namespace ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsReporting;

class ColumnHeader extends \ahrefs\AhrefsSeo_Vendor\Google\Collection
{
    protected $collection_key = 'dimensions';
    /**
     * @var string[]
     */
    public $dimensions;
    protected $metricHeaderType = \ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsReporting\MetricHeader::class;
    protected $metricHeaderDataType = '';
    /**
     * @param string[]
     */
    public function setDimensions($dimensions)
    {
        $this->dimensions = $dimensions;
    }
    /**
     * @return string[]
     */
    public function getDimensions()
    {
        return $this->dimensions;
    }
    /**
     * @param MetricHeader
     */
    public function setMetricHeader(\ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsReporting\MetricHeader $metricHeader)
    {
        $this->metricHeader = $metricHeader;
    }
    /**
     * @return MetricHeader
     */
    public function getMetricHeader()
    {
        return $this->metricHeader;
    }
}
// Adding a class alias for backwards compatibility with the previous class name.
\class_alias(\ahrefs\AhrefsSeo_Vendor\Google\Service\AnalyticsReporting\ColumnHeader::class, 'ahrefs\\AhrefsSeo_Vendor\\Google_Service_AnalyticsReporting_ColumnHeader');
