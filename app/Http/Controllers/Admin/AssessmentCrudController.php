<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DefaultCrudController;
use App\Http\Requests\AssessmentRequest as StoreRequest;
use App\Http\Requests\AssessmentRequest as UpdateRequest;
use App\Models\Assessment;

class AssessmentCrudController extends DefaultCrudController
{
    public function setup()
    {
        parent::setDefaults('assessment');
        $this->crud->setModel(Assessment::class);
        parent::setupFields(Assessment::crudFields());
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
