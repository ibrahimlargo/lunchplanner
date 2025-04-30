<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Caterer extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'order_url', 'address'];
}
