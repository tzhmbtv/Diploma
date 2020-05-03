<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\HigherOrderBuilderProxy;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Gate
 *
 * @package App\Models
 * @mixin Builder
 */
class Gate extends Model
{

    /**
     * @var string
     */
    private $camera_ip;
    /**
     * @var string
     */
    private $photo_uri;
    /**
     * @var int
     */
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPhotoUri(): string
    {
        return $this->photo_uri;
    }

    /**
     * @param string $photo_uri
     */
    public function setPhotoUri(string $photo_uri): void
    {
        $this->photo_uri = $photo_uri;
    }

    /**
     * @return string
     */
    public function getCameraIp(): string
    {
        return $this->camera_ip;
    }

    /**
     * @param string $camera_ip
     */
    public function setCameraIp(string $camera_ip): void
    {
        $this->camera_ip = $camera_ip;
    }

}
