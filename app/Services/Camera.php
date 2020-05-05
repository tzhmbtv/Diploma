<?php

namespace App\Services;

use App\Models\Gate;

class Camera
{

    private Gate $gate;

    /**
     * Camera constructor.
     *
     * @param Gate $gate
     */
    public function __construct(Gate $gate)
    {
        $this->gate = $gate;
    }

    /**
     * @return string
     */
    public function getImage(): string
    {
        return file_get_contents($this->gate->getCameraIp().$this->gate->getPhotoUri());
    }
}
