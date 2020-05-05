<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Class Gate
 *
 * @package App\Models
 * @mixin Builder
 */
class Gate extends Model
{
    /**
     * @return string
     */
    public function getPhotoUri(): string
    {
        return $this->attributes['photo_uri'];
    }

    /**
     * @param string $photo_uri
     */
    public function setPhotoUri(string $photo_uri): void
    {
        $this->attributes['photo_uri'] = $photo_uri;
    }

    /**
     * @return string
     */
    public function getCameraIp(): string
    {
        return $this->attributes['camera_ip'];
    }

    /**
     * @param string $camera_ip
     */
    public function setCameraIp(string $camera_ip): void
    {
        $this->attributes['camera_ip'] = $camera_ip;
    }

    public function cars()
    {
        return $this->belongsToMany('App\Models\Car');
    }
}
