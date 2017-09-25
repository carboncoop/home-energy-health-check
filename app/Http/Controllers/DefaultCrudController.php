<?php

namespace App\Http\Controllers;

use Backpack\CRUD\app\Http\Controllers\CrudController;

class DefaultCrudController extends CrudController
{
    public function setDefaults($slug)
    {
        $plural = str_plural($slug);
        $route = config('backpack.base.route_prefix') . '/' . $plural;
        $this->crud->setRoute($route);
        $this->crud->setEntityNameStrings($slug, $plural);
    }
}
