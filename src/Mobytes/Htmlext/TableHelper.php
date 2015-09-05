<?php
/*
 *
 *  * Copyright (C) 2015 eveR Vásquez.
 *  *
 *  * Licensed under the Apache License, Version 2.0 (the "License");
 *  * you may not use this file except in compliance with the License.
 *  * You may obtain a copy of the License at
 *  *
 *  *      http://www.apache.org/licenses/LICENSE-2.0
 *  *
 *  * Unless required by applicable law or agreed to in writing, software
 *  * distributed under the License is distributed on an "AS IS" BASIS,
 *  * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *  * See the License for the specific language governing permissions and
 *  * limitations under the License.
 *
 */

namespace Mobytes\Htmlext;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\Factory as View;

/**
 * Class TableHelper
 * @package Mobytes\Htmlext\Facade
 */
class TableHelper
{
    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var View
     */
    protected $view;

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var array
     */
    protected $config;


    /**
     * @param View $view
     * @param array $config
     */
    public function __construct(View $view, array $config=[])
    {
        $this->view = $view;
        $this->config = $config;
    }

    /**
     * @param $model
     * @return array|null
     */
    public function convertModelToArray($model)
    {
        if (!$model) {
            return null;
        }
        if ($model instanceof Model) {
            return $model->toArray();
        }
        if ($model instanceof Collection) {
            return $model->all();
        }
        return $model;
    }

    /**
     * @return View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param string $key
     * @param string $default
     * @return mixed
     */
    public function getConfig($key, $default = null)
    {
        return array_get($this->config, $key, $default);
    }

    /**
     * Merge options array
     *
     * @param array $first
     * @param array $second
     * @return array
     */
    public function mergeOptions(array $first, array $second)
    {
        return array_replace_recursive($first, $second);
    }
}