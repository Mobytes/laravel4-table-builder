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


/**
 * Class TableField
 * @package Mobytes\Htmlext
 */
class TableField
{
    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var
     */
    protected $name;
    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var bool
     */
    protected $rendered = true;
    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var void
     */
    protected $template = "htmlext::table";

    protected $template_tbody = "htmlext::tbody";

    protected $template_thead = "htmlext::thead";

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var
     */
    protected $valueProperty;

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var array
     */
    protected $options;

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var array
     */
    protected $items = [];

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var Table
     */
    protected $parent;

    /**
     * @autor eveR Vásquez
     * @link http://evervasquez.me
     * @var \Mobytes\Htmlext\TableHelper
     */
    protected $tableHelper;

    protected $thead;
    protected $tbody;

    /**
     * @param $name
     * @param Table $parent
     * @param array $items
     * @param array $options
     */
    public function __construct($name, Table $parent, array $items =[],array $options = [])
    {
        $this->name = $name;
        $this->options = $options;
        $this->items = $items;
        $this->parent = $parent;
        $this->tableHelper = $this->parent->getTableHelper();

        //options
    }


    private function renderThead()
    {
        $this->thead = $this->tableHelper->getView()
            ->make($this->template_thead,[
                'thead' => array_get($this->parent->getThead(),"title")
            ])->render();
    }

    private function renderTbody()
    {
        $this->tbody = $this->tableHelper->getView()
            ->make($this->template_tbody,[
                'tbody' => array_get($this->parent->getTbody(),"fields"),
                'name_route' => $this->parent->getName(),
                'items' => $this->items
            ])->render();
    }
    /**
     * @return string
     */
    public function render()
    {
        $this->renderThead();
        $this->renderTbody();

        return $this->tableHelper->getView()->make(
            $this->template,
            [
                'thead' => $this->thead,
                'tbody' => $this->tbody,
                'title' => $this->parent->getTitle(),
                'fields' => $this->parent->getFields(),
                'name_btn' => $this->parent->getNameBtnNew(),
                'paginator' => $this->parent->getPaginator()
            ]
        )->render();
    }
}