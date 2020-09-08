<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Store extends Model
{
    protected $fillable = ['owner_email','owner_password','name','url','status'];

    public function setOwnerPasswordAttribute($value)
    {
        $this->attributes['owner_password'] = Hash::make($value);
    }
}
