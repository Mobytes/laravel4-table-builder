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

use Illuminate\Database\Eloquent\Builder;
use App;


/**
 * Class TableBuilderTrait
 * @package Mobytes\Htmlext
 */
trait TableBuilderTrait
{

    /**
     * @param $tableClass
     * @param Builder $collection
     * @param array $options
     * @return mixed
     */
    protected function table($tableClass, Builder $collection ,array $options = [])
    {
        return App::make('Mobytes\Htmlext\TableBuilder')->create($tableClass, $collection, $options);
    }


    /**
     * @param array $options
     * @param array $data
     * @return mixed
     */
    protected function plain(array $options = [], array $data = [])
    {
        return App::make('Mobytes\Htmlext\TableBuilder')->plain($options, $data);
    }
}