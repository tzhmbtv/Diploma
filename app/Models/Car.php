<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Car
 *
 * @package App\Models
 * @mixin Builder
 */
class Car extends Model
{
    public function gates()
    {
        return $this->belongsToMany('App\Models\Gate')->withPivot('has_access');
    }
}
