<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DefaultCrudController;
use App\Http\Requests\SectionRequest as StoreRequest;
use App\Http\Requests\SectionRequest as UpdateRequest;
use App\Models\Section;

class SectionCrudController extends DefaultCrudController
{
    public function setup()
    {
        parent::setDefaults('section');
        $this->crud->setModel(Section::class);
        parent::setupFields(Section::crudFields());
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
