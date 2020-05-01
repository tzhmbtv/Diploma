<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class BaseModel extends Model
{
    protected $rules = ['id' => 'required|integer'];

    /**
     * @return boolean
     */
    private function validate()
    {
        $validator = Validator::make(json_decode(json_encode($this), true), $this->rules);

        return $validator->passes();
    }
}
