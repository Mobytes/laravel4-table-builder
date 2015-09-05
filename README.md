# Laravel 4.2 table builder

Table builder for **Laravel 4.2** 

###Installation

``` json
{
    "require": {
        "mobytes/laravel4-table-builder": "dev-master"
    }
}
```

run `composer update`

Then add Service provider to `config/app.php`

``` php
    'providers' => [
        // ...
        'Mobytes\Htmlext\HtmlextServiceProvider'
    ]
```

And Facade (also in `config/app.php`)

``` php
    'aliases' => [
        // ...
        'TableBuilder'	  => 'Mobytes\Htmlext\Facade\TableBuilder',
    ]

```

### Quick start

Create a class with the table settings

```php
<?php namespace App\Tables;

use Mobytes\Htmlext\Table;

class NoticeTable extends Table
{
    //create text button
    protected $btn_new = "Crear nueva noticia";
    
    //Table title 
    protected $title = "Todas las noticias de cepco.org.pe";
    
    //activate the paginate
    protected $paginate = true;
    
    //number of records per page
    protected $per_page = 7;
    
    //Titles of thead
    protected $thead = array(
        "title" => [
            "Titulo",
            "Subtitulo",
            "Contenido",
            "Tags",
            "Actions"
        ]
    );
    
    //records tbody
    protected $tbody = array(
        "fields" => [
            "titulo" => [
                "class" => ""
            ],
            "subtitulo" => [
                "class" => ""
            ],
            "contenido" => [
                "class" => ""
            ],
            "tags" => [
                "class" => ""
            ]
        ]
     );
    
    //Start function    
    public function build()
    {
        $prefix_router = "landpage.noticias";
        $this->build($prefix_router);
    }
}
```

After that instantiate the class in the controller and pass it to view:

```php
<?php namespace App/Http/Controllers;

use Illuminate\Routing\Controller as BaseController;
use Mobytes\Htmlext\TableBuilderTrait;

class NoticesController extends BaseController {
    
    // ...
    use TableBuilderTrait;
    
    public function index()
    {
        //notices type Builder
        $notices = $this->publication->getAllByType(self::$_NOTICE);
        
        $table = $this->table('Mobytes\Landpage\Publication\Table\NoticeTable',$notices);
        
        return View::make(Config::get('notices.index'), compact('table'));
    }
}
```

Print the form in view with `table()` helper function:

```html
<!-- views/notices/index.blade.php -->

@extend('layouts.master')

@section('content')
    {{{ table($table) }}}
@endsection
```
