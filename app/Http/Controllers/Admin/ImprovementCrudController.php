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
        $this->crud->setFromDb();
        $this->crud->removeColumns(['assessor_guidance', 'assessor_comment']);
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
