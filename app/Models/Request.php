<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Request
 *
 * @package App\Models
 */
class Request extends Model
{
    /**
     * @var integer
     */
    private $gate_id;
    /**
     * @var string
     */
    private $request_image_url;

    /**
     * @var string
     */
    private $response_from_nrp;

    /**
     * @return int
     */
    public function getGateId(): int
    {
        return $this->gate_id;
    }

    /**
     * @param int $gate_id
     */
    public function setGateId(int $gate_id): void
    {
        $this->gate_id = $gate_id;
    }

    /**
     * @return string
     */
    public function getRequestImageUrl(): string
    {
        return $this->request_image_url;
    }

    /**
     * @param string $request_image_url
     */
    public function setRequestImageUrl(string $request_image_url): void
    {
        $this->request_image_url = $request_image_url;
    }

    /**
     * @return string
     */
    public function getResponseFromNrp(): string
    {
        return $this->response_from_nrp;
    }

    /**
     * @param string $response_from_nrp
     */
    public function setResponseFromNrp(string $response_from_nrp): void
    {
        $this->response_from_nrp = $response_from_nrp;
    }
}
