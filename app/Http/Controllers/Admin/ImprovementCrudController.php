<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DefaultCrudController;
use App\Http\Requests\ImprovementRequest as StoreRequest;
use App\Http\Requests\ImprovementRequest as UpdateRequest;
use App\Models\Improvement;

class ImprovementCrudController extends DefaultCrudController
{
    public function setup()
    {
        parent::setDefaults('improvement');
        $this->crud->setModel(Improvement::class);
        parent::setupFields(Improvement::crudFields());
    }

    public function store(StoreRequest $request)
    {
        return parent::storeCrud($request);
    }

    public function update(UpdateRequest $request)
    {
        return parent::updateCrud($request);
    }
}
