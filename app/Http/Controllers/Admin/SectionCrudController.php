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
        $this->crud->setFromDb();
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
