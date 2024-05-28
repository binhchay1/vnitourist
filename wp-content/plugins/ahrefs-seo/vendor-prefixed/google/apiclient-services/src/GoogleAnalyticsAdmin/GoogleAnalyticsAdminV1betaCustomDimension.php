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
namespace ahrefs\AhrefsSeo_Vendor\Google\Service\GoogleAnalyticsAdmin;

class GoogleAnalyticsAdminV1betaCustomDimension extends \ahrefs\AhrefsSeo_Vendor\Google\Model
{
    /**
     * @var string
     */
    public $description;
    /**
     * @var bool
     */
    public $disallowAdsPersonalization;
    /**
     * @var string
     */
    public $displayName;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $parameterName;
    /**
     * @var string
     */
    public $scope;
    /**
     * @param string
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }
    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * @param bool
     */
    public function setDisallowAdsPersonalization($disallowAdsPersonalization)
    {
        $this->disallowAdsPersonalization = $disallowAdsPersonalization;
    }
    /**
     * @return bool
     */
    public function getDisallowAdsPersonalization()
    {
        return $this->disallowAdsPersonalization;
    }
    /**
     * @param string
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }
    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }
    /**
     * @param string
     */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @param string
     */
    public function setParameterName($parameterName)
    {
        $this->parameterName = $parameterName;
    }
    /**
     * @return string
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }
    /**
     * @param string
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }
    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }
}
// Adding a class alias for backwards compatibility with the previous class name.
\class_alias(\ahrefs\AhrefsSeo_Vendor\Google\Service\GoogleAnalyticsAdmin\GoogleAnalyticsAdminV1betaCustomDimension::class, 'ahrefs\\AhrefsSeo_Vendor\\Google_Service_GoogleAnalyticsAdmin_GoogleAnalyticsAdminV1betaCustomDimension');
