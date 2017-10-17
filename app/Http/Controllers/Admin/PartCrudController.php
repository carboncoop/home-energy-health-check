<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DefaultCrudController;
use App\Http\Requests\PartRequest as StoreRequest;
use App\Http\Requests\PartRequest as UpdateRequest;
use App\Models\Part;

class PartCrudController extends DefaultCrudController
{
    public function setup()
    {
        parent::setDefaults('part');
        $this->crud->setModel(Part::class);
        parent::setupFields(Part::crudFields());
    }

    public function store(StoreRequest $request)
    {
        $redirect_location = parent::storeCrud($request);
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        $redirect_location = parent::updateCrud($request);
        return $redirect_location;
    }
}
