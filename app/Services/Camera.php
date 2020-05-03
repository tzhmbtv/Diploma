<?php

namespace App\Services;

use App\Models\Gate;
use GuzzleHttp\Client;

class Camera
{
    /**
     * @var Client
     */
    private $client;
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
        $this->client = new Client(
            ['base_uri' => $gate->getCameraIp()]
        );
    }

    /**
     * @return string
     */
    public function getImage()
    {
        $result              = $this->client->request(
            "GET",
            $this->gate->getPhotoUri()
        )->getBody()->getContents();
        $this->imageAsString = $result;

        return $result;
    }

    /**
     * @return int
     */
    public function getGateId()
    {
        return $this->gate->getId();
    }

    /**
     * @return string
     */
    public function getImageAsString()
    {
        return $this->imageAsString;
    }
}
