<?php

namespace App\Services;

use App\Models\Gate;
use GuzzleHttp\Client;

class Camera
{
    /**
     * @var Gate
     */
    private $gate;

    /**
     * @var string
     */
    private $imageAsString;

    /**
     * Camera constructor.
     *
     * @param Gate $gate
     */
    public function __construct(Gate $gate)
    {
        $this->gate   = $gate;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $this->imageAsString = file_get_contents("C:\\Users\\User\\Downloads\\nomera-main-1193x671.jpg");

        return $this->imageAsString;
    }

    /**
     * @return int
     */
    public function getGateId()
    {
        return $this->gate->attributesToArray()['id'];
    }

    /**
     * @return string
     */
    public function getImageAsString()
    {
        return base64_encode($this->imageAsString);
    }
}
