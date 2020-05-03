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
     * @return int
     */
    public function getGateId(): int
    {
        return $this->attributes['gate_id'];
    }

    /**
     * @param int $gate_id
     */
    public function setGateId(int $gate_id): void
    {
        $this->attributes['gate_id'] = $gate_id;
    }

    /**
     * @return string
     */
    public function getRequestImageUrl(): string
    {
        return $this->attributes['request_image_url'];
    }

    /**
     * @param string $request_image_url
     */
    public function setRequestImageUrl(string $request_image_url): void
    {
        $this->attributes['request_image_url'] = $request_image_url;
    }

    /**
     * @return string
     */
    public function getResponseFromNrp(): string
    {
        return $this->attributes['response_from_nrp'];

    }

    /**
     * @param string $response_from_nrp
     */
    public function setResponseFromNrp(string $response_from_nrp): void
    {
        $this->attributes['response_from_nrp'] = $response_from_nrp;
    }
}
