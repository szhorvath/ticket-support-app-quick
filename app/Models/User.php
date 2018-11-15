<?php

namespace App\Models;

use App\Models\Model;
use App\Services\Auth\Contracts\JwtSubject;

class User extends Model implements JwtSubject
{
    protected $hidden = [
        'password',
    ];

    protected $dates = [
        'updated_at',
        'created_at',
    ];

    public function getJwtIdentifier()
    {
        return $this->id;
    }

    public function getFullNameOrUsername()
    {
        return $this->getFullName()?: $this->username;
    }

    public function getFullName()
    {
        if ($this->first_name && $this->last_name) {
            return "{$this->first_name} {$this->last_name}";
        }

        return null;
    }
}
