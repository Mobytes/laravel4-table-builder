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

class Table
{

    protected $table;

    protected $btn_new = "nuevo";

    protected $name = null;

    protected $exclude = [];

    protected $fields = [];

    protected $title = "Lista de Registros";

    protected $rebuilding = false;

    protected $paginate = false;

    protected $per_page = 10;

    protected $actions_default = ['view', 'edit', 'create', 'delete'];

    protected $container;

    protected $tableHelper;

    protected $tableBuilder;

    protected $tableOptions = [];

    protected $data = [];

    protected $num_paginate;

    protected $model;

    protected $paginator;

    protected $thead = [];

    protected $tbody = [];

    protected $appends_paginate = ["search"];

    /**
     * Table constructor.
     * @param $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function buildTable()
    {
        //build table
    }


    /**
     * @param $name
     * @param array $options
     * @param bool|false $modify
     */
    public function build($name = null, array $options = [], $modify = false)
    {
        $this->name = $name;
        $this->table = new TableField($name, $this, $this->data, $options);
    }


    public function rebuildTable()
    {
        $this->rebuilding = true;
        // If form is plain, buildForm method is empty, so we need to take
        // existing fields and add them again
        if (get_class($this) === 'Mobytes\Htmlext\Table') {
            $this->addHeader();
        } else {
            $this->buildTable();
        }

        $this->rebuilding = false;

        return $this;
    }


    /**
     * Set form builder instance on helper so we can use it later
     *
     * @param TableBuilder $tableBuilder
     * @return $this
     */
    public function setTableBuilder(TableBuilder $tableBuilder)
    {
        $this->tableBuilder = $tableBuilder;
        return $this;
    }

    /**
     * @param TableHelper $tableHelper
     * @return $this
     */
    public function setTableHelper(TableHelper $tableHelper)
    {
        $this->tableHelper = $tableHelper;
        return $this;
    }

    public function setTableOptions($options)
    {
        foreach ($options as $key => $option) {
            $this->tableOptions[$key] = $option;
        }

        return $this;
    }

    /**
     * Get single additional data
     *
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function getData($name = null, $default = null)
    {
        if (is_null($name)) {
            return $this->data;
        }
        return array_get($this->data, $name, $default);
    }

    public function addData(Builder $data)
    {

        if ($this->paginate) {
            $this->paginator = $data->paginate($this->per_page);
        }

        foreach ($data->get() as $key => $value) {
            $this->setData($key, $value->toArray());
        }

        return $this;
    }

    public function setData($key, $data)
    {
        $this->data[$key] = $data;
    }

    /**
     * Check if form has field
     *
     * @param $name
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->tr);
    }


    /**
     * Render full form
     *
     * @param array $options
     * @param bool $showStart
     * @param bool $showFields
     * @param bool $showEnd
     * @return string
     */
    public function renderTable(array $options = [], $showStart = true, $showFields = true, $showEnd = true)
    {
        return $this->render($options, $this->table, $showStart, $showFields, $showEnd);
    }

    /**
     * Render the form
     *
     * @param $options
     * @param $table
     * @param boolean $showStart
     * @param boolean $showFields
     * @param boolean $showEnd
     * @return string
     */
    protected function render($options, $table, $showStart, $showFields, $showEnd)
    {
        $tableOptions = $this->tableHelper->mergeOptions($this->tableOptions, $options);

        $this->setupNamedModel();

//        return $this->tableHelper->getView()
//            ->make($this->tableHelper->getConfig('table'))
////            ->with(compact('showStart', 'showFields', 'showEnd'))
////            ->with('formOptions', $formOptions)
//            ->with('tr', $tr)
//            ->with('model', $this->getModel())
//            ->with('exclude', $this->exclude)
//            ->render();

        return $this->table->render();
    }

    /**
     * Set namespace to model if form is named so the data is bound properly
     */
    protected function setupNamedModel()
    {
        if (!$this->getModel() || !$this->getName()) {
            return;
        }
        $model = $this->tableHelper->convertModelToArray($this->getModel());
        if (!array_get($model, $this->getName())) {
            $this->model = [
                $this->getName() => $model
            ];
        }
    }

    /**
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get model that is bind to form object
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set model to form object
     *
     * @param mixed $model
     * @return $this
     */
    public function setModel($model)
    {
        $this->model = $model;
        $this->setupNamedModel();
        return $this;
    }

    /**
     * Get form helper
     *
     * @return TableHelper
     */
    public function getTableHelper()
    {
        return $this->tableHelper;
    }

    public function getPaginate()
    {
        return $this->paginate;
    }

    public function getTableOptions(){
        return $this->tableOptions;
    }

    public function getPaginator()
    {
        if ($this->paginate) {
            return $this->paginator;
        }

        return null;
    }

    public function getNameBtnNew()
    {
        return $this->btn_new;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getFields()
    {
        return $this->fields;
    }

    public function getThead()
    {
        return $this->thead;
    }

    public function getTbody()
    {
        return $this->tbody;
    }
}