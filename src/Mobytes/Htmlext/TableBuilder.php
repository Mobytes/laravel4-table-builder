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
use Illuminate\Foundation\Application as Container;
use Illuminate\Support\Collection;
/**
 * Class TableBuilder
 * @package Mobytes\Htmlext
 */
class TableBuilder
{
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

    public function create($tableClass, Builder $collection,array $options = [])
    {
        $class = $this->getNamespaceFromConfig() . $tableClass;
        
        if (!class_exists($class)) {
            throw new \InvalidArgumentException(
                'Table class with name ' . $class . ' does not exist.'
            );
        }

        $table = $this->container
            ->make($class)
            ->setTableHelper($this->tableHelper)
            ->setTableBuilder($this)
//            ->setTableOptions($options)
            ->addData($collection);

        $table->buildTable();

        return $table;
    }

    /**
     * Get the namespace from the config
     *
     * @return string
     */
    protected function getNamespaceFromConfig()
    {
        $namespace = $this->tableHelper->getConfig('default_namespace');
        if (!$namespace) {
            return '';
        }
        return $namespace . '\\';
    }

}