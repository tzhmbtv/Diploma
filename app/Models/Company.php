<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @package App\Models
 * @mixin Builder
 */
class Company extends Model
{
    public static array $rules = [
        'short_name '    => 'required',
        'official_name ' => 'required',
    ];

    private string $short_name;
    private string $official_name;

    public function getShortName(): string
    {
        return $this->short_name;
    }

    public function setShortName(string $short_name): void
    {
        $this->short_name = $short_name;
    }

    public function getOfficialName(): string
    {
        return $this->official_name;
    }

    public function setOfficialName(string $official_name): void
    {
        $this->official_name = $official_name;
    }

}
