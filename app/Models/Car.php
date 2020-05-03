<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 *
 * @package App\Models
 */
class Car extends Model
{
    public function gates()
    {
        return $this->belongsToMany('App\Models\Gate');
    }
}
