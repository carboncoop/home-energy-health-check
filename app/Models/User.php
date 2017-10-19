<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Backpack\CRUD\CrudTrait;

class User extends Authenticatable
{
    use Notifiable, CrudTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function setPasswordAttribute($pass)
    {
        $this->attributes['password'] = \Hash::make($pass);
    }


    public static function crudFields()
    {
        return [
            'name' => [
                'label' => 'Name',
                'type' => 'text',
                'index' => true,
            ],
            'email' => [
                'label' => 'Email',
                'type' => 'email',
                'index' => true,
            ],
            'password' => [
                'label' => 'Password',
                'type' => 'password',
            ],
            'group' => [
                'label' => "User Group",
                'type' => 'select_from_array',
                'options' => [
                    'assessor' => 'Assessor',
                    'superuser' => 'Superuser',
                ],
                'allows_null' => false,
            ],
        ];
    }
}
