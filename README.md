# Laravel 4 table builder

Table builder for **Laravel 4** 
By default it supports Bootstrap 3.

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
        'TableBuilder' => 'Mobytes\Htmlext\Facade\TableBuilder'
    ]

```

### Quick start

Creating form classes is easy. Lets assume PSR-4 is set for loading namespace `App` in `app/Project` folder. With a simple artisan command we can create form:

```sh
php artisan make:form app/Project/Forms/SongForm --fields="name:text, lyrics:textarea, publish:checkbox"
```

Form is created in path `app/Project/Forms/SongForm.php` with content:

```php
<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SongForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text')
            ->add('lyrics', 'textarea')
            ->add('publish', 'checkbox');
    }
}
```

If you want to instantiate empty form without any fields, just skip passing `--fields` parameter:

```sh
    php artisan make:form app/Project/Forms/PostForm
```

Gives:

```php
<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
    }
}
```

After that instantiate the class in the controller and pass it to view:

```php
<?php namespace App/Http/Controllers;

use Illuminate\Routing\Controller as BaseController;
use Kris\LaravelFormBuilder\FormBuilder;

class SongsController extends BaseController {

    public function create()
    {
        $form = \FormBuilder::create('App\Forms\SongForm', [
            'method' => 'POST',
            'url' => route('song.store')
        ]);

        return view('song.create', compact('form'));
    }
}
```

Print the form in view with `form()` helper function:

```html
<!-- resources/views/song/create.blade.php -->

@extend('layouts.master')

@section('content')
    {{{ form($form) }}}
@endsection
```

Above code will generate this html:

```html
<form method="POST" action="http://example.dev/songs">
    <input name="_token" type="hidden" value="FaHZmwcnaOeaJzVdyp4Ml8B6l1N1DLUDsZmsjRFL">
    <div class="form-group">
        <label for="name" class="control-label">Name</label>
        <input type="text" class="form-control" id="name">
    </div>
    <div class="form-group">
        <label for="lyrics" class="control-label">Lyrics</label>
        <textarea name="lyrics" class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="publish" class="control-label">Publish</label>
        <input type="checkbox" name="publish" id="publish">
    </div>
</form>
```
