<?php

namespace App\Services;

use App\Models\Request;

class RequestLogger
{
    public static function logRequestToNpr(int $gateId, array $responseFromNrp, string $imageAsString)
    {
        $request = new Request();
        $request->setGateId($gateId);
        $request->setResponseFromNrp(json_encode($responseFromNrp, true));
        $request->setRequestImageUrl(base64_encode($imageAsString));
        $request->save();
    }
}
