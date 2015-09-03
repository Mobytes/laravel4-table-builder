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

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Traits\MacroableTrait;
use Illuminate\Foundation\Application as Container;
use Mobytes\Htmlext\Facade\TableHelper;

/**
 * Class TableBuilder
 * @package Mobytes\Htmlext
 */
class TableBuilder
{
    use MacroableTrait;

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var
     */
    protected $container;

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var
     */
    protected $tableHelper;


    /**
     * @param Container $container
     * @param TableHelper $tableHelper
     */
    public function __construct(Container $container, TableHelper $tableHelper)
    {
        $this->container = $container;
        $this->tableHelper = $tableHelper;
    }


    /**
     * @param Collection $collection
     */
    public function build(Collection $collection)
    {
        foreach($collection as $model)
        {
            dd($model->getAttributes());
        }
    }

    /**
     *
     */
    public function createTable()
    {

    }
}