<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\DefaultCrudController;
use App\Http\Requests\UserRequest as StoreRequest;
use App\Http\Requests\UserRequest as UpdateRequest;
use App\Models\User;

class UserCrudController extends DefaultCrudController
{
    public function setup()
    {
        parent::setDefaults('user');
        $this->crud->setModel(User::class);
        parent::setupFields(User::crudFields());
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
