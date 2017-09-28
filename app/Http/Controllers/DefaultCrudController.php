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

    public function setupFields($fields)
    {
        foreach ($fields as $name => $args) {
            $args['name'] = $name;
            if (array_key_exists('index', $args) && true == $args['index']) {
                unset($args['index']);
                $this->crud->addColumn($args);
            }
            $this->crud->addField($args);
        }
    }

}
