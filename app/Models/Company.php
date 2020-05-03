<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 *
 * @package App\Models
 */
class Company extends Model
{
    public static $rules = [
        'short_name '    => 'required',
        'official_name ' => 'required',
    ];

    /**
     * @var string
     */
    private $short_name;
    /**
     * @var string
     */
    private $official_name;

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->short_name;
    }

    /**
     * @param string $short_name
     */
    public function setShortName(string $short_name): void
    {
        $this->short_name = $short_name;
    }

    /**
     * @return string
     */
    public function getOfficialName(): string
    {
        return $this->official_name;
    }

    /**
     * @param string $official_name
     */
    public function setOfficialName(string $official_name): void
    {
        $this->official_name = $official_name;
    }

}
